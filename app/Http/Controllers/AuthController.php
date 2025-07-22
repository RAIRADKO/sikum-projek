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
        // 1. Ambil semua input kecuali password dan token CSRF
        $credentials = $request->except(['password', '_token']);

        // 2. Jika tidak ada input lain selain password, kirim error
        if (empty($credentials)) {
            // Kita tidak tahu nama fieldnya, jadi buat pesan error umum
            return back()->withErrors(['login_error' => 'Kolom Nama Admin / NIP wajib diisi.']);
        }

        // 3. Ambil nama dan nilai dari field pertama yang ditemukan (pasti itu login identifier)
        $identifierKey = array_key_first($credentials);
        $loginIdentifier = $request->input($identifierKey);
        $password = $request->input('password');
        
        // Pastikan password diisi
        if (empty($password)) {
            return back()->withErrors(['password' => 'Password wajib diisi.'])->withInput();
        }

        // 4. Coba autentikasi sebagai admin (bisa pakai email atau nama)
        if (Auth::guard('admin')->attempt(['email' => $loginIdentifier, 'password' => $password]) || Auth::guard('admin')->attempt(['nama' => $loginIdentifier, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        // 5. Coba autentikasi sebagai user dengan NIP
        if (is_numeric($loginIdentifier)) {
            if (Auth::guard('web')->attempt(['nip' => $loginIdentifier, 'password' => $password])) {
                $user = Auth::guard('web')->user();

                if (!$user->is_approved) {
                    Auth::guard('web')->logout();
                    return back()->with('loginError', 'Akun Anda belum disetujui oleh admin.')
                                 ->withInput($request->except('password'));
                }

                $request->session()->regenerate();
                return redirect()->intended(route('home'));
            }
        }

        // 6. Jika semua percobaan gagal, kembali dengan pesan error
        // Arahkan pesan error ke field yang benar, apapun namanya
        return back()->withErrors([
            $identifierKey => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput($identifierKey);
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