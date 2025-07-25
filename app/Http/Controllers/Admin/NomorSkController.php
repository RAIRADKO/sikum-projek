<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NomorSk;
use App\Models\Opd;
use Illuminate\Http\Request;

class NomorSkController extends Controller
{
    public function index()
    {
        // Ganti latest() dengan orderBy('nosk', 'desc')
        $nomorSk = NomorSk::with('opd')->orderBy('nosk', 'desc')->paginate(10);
        return view('admin.nomorsk.index', compact('nomorSk'));
    }

    // ... (sisa kode controller tidak perlu diubah)
    public function create()
    {
        $opds = Opd::all();
        return view('admin.nomorsk.create', compact('opds'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nosk' => 'required|integer|unique:nomorsk,nosk',
            'tglsk' => 'nullable|date',
            'judulsk' => 'nullable|string',
            'kodeopd' => 'nullable|string|exists:opds,kodeopd',
            'tglturunsk' => 'nullable|date',
            'tglambilsk' => 'nullable|date',
            'namapengambilsk' => 'nullable|string|max:50',
            'ket' => 'nullable|string|max:255',
            'kodesk' => 'nullable|string|max:10',
            'status_bon' => 'required|in:dibon,tidak_dibon',
        ];

        // Validasi kondisional: jika status 'dibon', field bon menjadi wajib
        if ($request->input('status_bon') == 'dibon') {
            $rules['namabon'] = 'required|string|max:50';
            $rules['tglbon'] = 'required|date';
            $rules['alasanbonsk'] = 'required|string|max:255';
        }

        $validatedData = $request->validate($rules);

        $dataToCreate = $validatedData;
        
        // Jika status 'tidak_dibon', pastikan data bon di-set null
        if ($validatedData['status_bon'] == 'tidak_dibon') {
            $dataToCreate['namabon'] = null;
            $dataToCreate['tglbon'] = null;
            $dataToCreate['alasanbonsk'] = null;
        }

        NomorSk::create($dataToCreate);

        return redirect()->route('admin.nomorsk.index')->with('success', 'Nomor SK berhasil ditambahkan.');
    }

    public function update(Request $request, NomorSk $nomorsk)
    {
        $rules = [
            'tglsk' => 'nullable|date',
            'judulsk' => 'nullable|string',
            'kodeopd' => 'nullable|string|exists:opds,kodeopd',
            'tglturunsk' => 'nullable|date',
            'tglambilsk' => 'nullable|date',
            'namapengambilsk' => 'nullable|string|max:50',
            'ket' => 'nullable|string|max:255',
            'kodesk' => 'nullable|string|max:10',
            'status_bon' => 'required|in:dibon,tidak_dibon',
        ];

        // Validasi kondisional: jika status 'dibon', field bon menjadi wajib
        if ($request->input('status_bon') == 'dibon') {
            $rules['namabon'] = 'required|string|max:50';
            $rules['tglbon'] = 'required|date';
            $rules['alasanbonsk'] = 'required|string|max:255';
        }

        $validatedData = $request->validate($rules);

        $dataToUpdate = $validatedData;

        // Jika status 'tidak_dibon', pastikan data bon di-set null
        if ($validatedData['status_bon'] == 'tidak_dibon') {
            $dataToUpdate['namabon'] = null;
            $dataToUpdate['tglbon'] = null;
            $dataToUpdate['alasanbonsk'] = null;
        }

        $nomorsk->update($dataToUpdate);

        return redirect()->route('admin.nomorsk.index')->with('success', 'Nomor SK berhasil diperbarui.');
    }

    public function edit(NomorSk $nomorsk)
    {
        $opds = Opd::all();
        return view('admin.nomorsk.edit', compact('nomorsk', 'opds'));
    }

    public function destroy(NomorSk $nomorsk)
    {
        $nomorsk->delete();
        return redirect()->route('admin.nomorsk.index')->with('success', 'Nomor SK berhasil dihapus.');
    }
}