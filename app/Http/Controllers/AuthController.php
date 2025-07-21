<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Opd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Menangani proses login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = $request->input('login');
        $password = $request->input('password');

        // Cek apakah login menggunakan email (admin) atau NIP/whatsapp (user)
        $isEmail = filter_var($loginField, FILTER_VALIDATE_EMAIL);

        if ($isEmail) {
            // Coba login sebagai admin
            $admin = Admin::where('email', $loginField)->first();

            if ($admin && Hash::check($password, $admin->password)) {
                Auth::guard('admin')->login($admin, $request->filled('remember'));
                return redirect()->intended('/admin/dashboard');
            }
        } else {
            // Coba login sebagai user dengan NIP atau whatsapp
            $user = User::where('nip', $loginField)
                ->orWhere('whatsapp', $loginField)
                ->first();

            if ($user && Hash::check($password, $user->password)) {
                Auth::guard('web')->login($user, $request->filled('remember'));
                return redirect()->route('dashboard'); // Arahkan ke dashboard user
            }
        }

        return back()->withErrors([
            'login' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->withInput($request->only('login'));
    }

    /**
     * Menampilkan form registrasi.
     */
    public function showRegistrationForm()
    {
        $opds = Opd::all();
        return view('auth.register', compact('opds'));
    }

    /**
     * Menangani proses registrasi user.
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:users,nip',
            'whatsapp' => 'required|string|unique:users,whatsapp',
            'opd_id' => 'required|exists:opds,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'whatsapp' => $request->whatsapp,
            'opd_id' => $request->opd_id,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('web')->login($user);

        return redirect('/dashboard')->with('success', 'Registrasi berhasil!');
    }

    /**
     * Menangani proses logout untuk user dan admin.
     */
    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}