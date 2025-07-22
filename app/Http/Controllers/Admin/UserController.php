<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna (disetujui dan menunggu).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua user, diurutkan berdasarkan yang terbaru, dengan relasi OPD
        $users = User::with('opd')->latest()->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat pengguna baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::all();
        return view('admin.user.create', compact('opds'));
    }

    /**
     * Menyimpan pengguna baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:users',
            'opd_id' => 'required|exists:opds,id',
            'whatsapp' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'opd_id' => $request->opd_id,
            'whatsapp' => $request->whatsapp,
            'password' => Hash::make($request->password),
            'is_approved' => true, // User yang dibuat admin langsung disetujui
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit pengguna.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // Hanya user yang sudah disetujui yang bisa diedit
        if (!$user->is_approved) {
            return redirect()->route('admin.user.index')->with('error', 'Akun yang menunggu persetujuan tidak dapat diedit.');
        }
        $opds = Opd::all();
        return view('admin.user.edit', compact('user', 'opds'));
    }

    /**
     * Memperbarui data pengguna di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'opd_id' => 'required|exists:opds,id',
            'whatsapp' => 'required|string|max:15',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna dari database.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
         // Hanya user yang sudah disetujui yang bisa dihapus dari sini
        if (!$user->is_approved) {
            return redirect()->route('admin.user.index')->with('error', 'Gunakan tombol Tolak untuk menghapus pendaftaran yang menunggu.');
        }
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus.');
    }

    /**
     * Menyetujui pendaftaran pengguna.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function approve(User $user)
    {
        $user->update(['is_approved' => true]);
        return redirect()->route('admin.user.index')->with('success', 'Pendaftaran user telah disetujui.');
    }

    /**
     * Menolak dan menghapus pendaftaran pengguna.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function reject(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'Pendaftaran user telah ditolak dan dihapus.');
    }
}