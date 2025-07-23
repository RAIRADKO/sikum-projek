<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Opd;
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
        $validator = Validator::make($request->all(), [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $login = $request->input('login');
        $password = $request->input('password');

        $isAdminAttempt = Auth::guard('admin')->attempt(['email' => $login, 'password' => $password]) ||
                          Auth::guard('admin')->attempt(['nama' => $login, 'password' => $password]);

        if ($isAdminAttempt) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        if (is_numeric($login) && Auth::guard('web')->attempt(['nip' => $login, 'password' => $password])) {
            $user = Auth::guard('web')->user();

            if (!$user->is_approved) {
                Auth::guard('web')->logout();
                return back()->with('loginError', 'Akun Anda belum disetujui oleh admin.')
                             ->withInput($request->except('password'));
            }

            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'login' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('login');
    }

    public function showRegistrationForm()
    {
        $opds = Opd::orderBy('namaopd')->get();
        return view('auth.register', compact('opds'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nip' => ['required', 'string', 'size:18', 'unique:users,nip'],
            'whatsapp' => ['required', 'string', 'unique:users,whatsapp'],
            'opd_id' => ['required', 'exists:opds,kodeopd'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nip' => $request->nip,
            'whatsapp' => $request->whatsapp,
            'opd_id' => $request->opd_id,
            'password' => Hash::make($request->password),
            'is_approved' => false,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan tunggu persetujuan dari admin.');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}