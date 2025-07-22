<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Opd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ]);

        $loginIdentifier = $request->input('nip');
        $password = $request->input('password');

        // 1. Coba autentikasi sebagai admin dengan EMAIL (jika input berupa email)
        if (filter_var($loginIdentifier, FILTER_VALIDATE_EMAIL)) {
            if (Auth::guard('admin')->attempt(['email' => $loginIdentifier, 'password' => $password])) {
                $request->session()->regenerate();
                // FIX: Arahkan ke rute 'admin.dashboard'
                return redirect()->intended(route('admin.dashboard'));
            }
        }

        // 2. Coba autentikasi sebagai admin dengan NAMA (menggunakan kolom 'nama')
        if (Auth::guard('admin')->attempt(['nama' => $loginIdentifier, 'password' => $password])) {
            $request->session()->regenerate();
            // FIX: Arahkan ke rute 'admin.dashboard'
            return redirect()->intended(route('admin.dashboard'));
        }

        // 3. Coba autentikasi sebagai user dengan NIP (hanya jika input numerik)
        if (is_numeric($loginIdentifier)) {
            if (Auth::guard('web')->attempt(['nip' => $loginIdentifier, 'password' => $password])) {
                $request->session()->regenerate();
                // FIX: Arahkan ke rute 'dashboard'
                return redirect()->intended(route('dashboard'));
            }
        }

        return back()->with([
            'loginError' => 'Login Gagal! Periksa kembali NIP/Nama/Email dan Kata Sandi Anda.',
        ])->withInput($request->except('password'));
    }

    public function showRegistrationForm()
    {
        $opds = Opd::orderBy('nama_opd')->get();
        return view('auth.register', compact('opds'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nip' => ['required', 'string', 'size:18', 'unique:users,nip'],
            'whatsapp' => ['required', 'string', 'unique:users,whatsapp'],
            'opd_id' => ['required', 'exists:opds,id'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nip' => $request->nip,
            'whatsapp' => $request->whatsapp,
            'opd_id' => $request->opd_id,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    public function logout(Request $request)
    {
        $guard = Auth::guard('admin')->check() ? 'admin' : 'web';
        Auth::guard($guard)->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda berhasil logout.');
    }
}
