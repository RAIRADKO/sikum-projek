<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NomorPerbup;
use App\Models\Opd;
use App\Models\Seri;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NomorPerbupController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = NomorPerbup::with('opd');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nopb', 'like', "%{$search}%")
                  ->orWhere('judulpb', 'like', "%{$search}%")
                  ->orWhere('kodeopd', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }

        $nomorPerbup = $query->orderBy('nopb', 'desc')->paginate(10);
        $nomorPerbup->appends(['search' => $search]);

        return view('admin.nomorperbup.index', compact('nomorPerbup'));
    }

    public function create()
    {
        $opds = Opd::orderBy('namaopd')->get();
        $series = Seri::all();
        return view('admin.nomorperbup.create', compact('opds', 'series'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nopb' => 'required|integer|unique:nomorpb,nopb',
            'tglpb' => 'nullable|date',
            'judulpb' => 'nullable|string',
            'kodeopd' => 'nullable|string|exists:opds,kodeopd',
            'seri' => 'nullable|string|exists:seri,seri',
            'noseri' => 'nullable|integer',
            'status' => ['required', Rule::in(['proses', 'selesai', 'diambil'])],
            'ket' => 'nullable|string|max:255',
            'kodepb' => 'nullable|string|max:10',
        ]);

        NomorPerbup::create($request->all());

        return redirect()->route('admin.nomorperbup.index')->with('success', 'Nomor Perbup berhasil ditambahkan.');
    }

    public function edit(NomorPerbup $nomorperbup)
    {
        $opds = Opd::orderBy('namaopd')->get();
        $series = Seri::all();
        return view('admin.nomorperbup.edit', compact('nomorperbup', 'opds', 'series'));
    }

    public function update(Request $request, NomorPerbup $nomorperbup)
    {
        $request->validate([
            'tglpb' => 'nullable|date',
            'judulpb' => 'nullable|string',
            'kodeopd' => 'nullable|string|exists:opds,kodeopd',
            'seri' => 'nullable|string|exists:seri,seri',
            'noseri' => 'nullable|integer',
            'status' => ['required', Rule::in(['proses', 'selesai', 'diambil'])],
            'ket' => 'nullable|string|max:255',
            'kodepb' => 'nullable|string|max:10',
        ]);

        $nomorperbup->update($request->all());

        return redirect()->route('admin.nomorperbup.index')->with('success', 'Nomor Perbup berhasil diperbarui.');
    }

    public function destroy(NomorPerbup $nomorperbup)
    {
        $nomorperbup->delete();
        return redirect()->route('admin.nomorperbup.index')->with('success', 'Nomor Perbup berhasil dihapus.');
    }
}