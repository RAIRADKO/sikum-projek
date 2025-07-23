<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OpdController extends Controller
{
    /**
     * Menampilkan daftar OPD.
     */
    public function index()
    {
        $opds = Opd::orderBy('namaopd')->paginate(10);
        return view('admin.opd.index', compact('opds'));
    }

    /**
     * Menampilkan form untuk membuat OPD baru.
     */
    public function create()
    {
        return view('admin.opd.create');
    }

    /**
     * Menyimpan OPD baru ke database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_opd' => ['required', 'string', 'max:255', 'unique:opds'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.opd.create')
                ->withErrors($validator)
                ->withInput();
        }

        Opd::create($request->all());

        return redirect()->route('admin.opd.index')->with('success', 'OPD berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit OPD.
     */
    public function edit(Opd $opd)
    {
        return view('admin.opd.edit', compact('opd'));
    }

    /**
     * Memperbarui data OPD di database.
     */
    public function update(Request $request, Opd $opd)
    {
        $validator = Validator::make($request->all(), [
            'nama_opd' => ['required', 'string', 'max:255', 'unique:opds,nama_opd,' . $opd->id],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.opd.edit', $opd)
                ->withErrors($validator)
                ->withInput();
        }

        $opd->update($request->all());

        return redirect()->route('admin.opd.index')->with('success', 'OPD berhasil diperbarui.');
    }

    /**
     * Menghapus OPD dari database.
     */
    public function destroy(Opd $opd)
    {
        // Cek jika ada user yang terhubung dengan OPD ini
        if ($opd->users()->count() > 0) {
            return redirect()->route('admin.opd.index')->with('error', 'OPD tidak dapat dihapus karena masih memiliki user terdaftar.');
        }

        $opd->delete();

        return redirect()->route('admin.opd.index')->with('success', 'OPD berhasil dihapus.');
    }
}