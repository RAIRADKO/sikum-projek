<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NomorSk;
use App\Models\Opd;
use Illuminate\Http\Request; // Pastikan Request di-import
use Illuminate\Validation\Rule;

class NomorSkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query dasar
        $query = NomorSk::with('opd');

        // Jika ada input pencarian, tambahkan kondisi 'where'
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nosk', 'like', "%{$search}%")
                  ->orWhere('judulsk', 'like', "%{$search}%")
                  ->orWhere('kodeopd', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }

        // Ambil data dengan paginasi dan urutkan
        $nomorSk = $query->orderBy('nosk', 'desc')->paginate(10);

        // Penting: agar link paginasi tetap menyertakan query pencarian
        $nomorSk->appends(['search' => $search]);

        return view('admin.nomorsk.index', compact('nomorSk'));
    }

    // ... sisa method lainnya tidak berubah ...
    public function create()
    {
        $opds = Opd::all();
        return view('admin.nomorsk.create', compact('opds'));
    }

    // (store, edit, update, destroy)
    // ...
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

        if ($request->input('status_bon') == 'dibon') {
            $rules['namabon'] = 'required|string|max:50';
            $rules['tglbon'] = 'required|date';
            $rules['alasanbonsk'] = 'required|string|max:255';
        }

        $validatedData = $request->validate($rules);
        $dataToCreate = $validatedData;
        
        // Atur status berdasarkan status_bon
        $dataToCreate['status'] = ($validatedData['status_bon'] == 'dibon') ? 'bon' : 'proses';
        
        if ($dataToCreate['status'] == 'proses') {
            $dataToCreate['namabon'] = null;
            $dataToCreate['tglbon'] = null;
            $dataToCreate['alasanbonsk'] = null;
        }

        NomorSk::create($dataToCreate);

        return redirect()->route('admin.nomorsk.index')->with('success', 'Nomor SK berhasil ditambahkan.');
    }

    public function edit(NomorSk $nomorsk)
    {
        $opds = Opd::all();
        return view('admin.nomorsk.edit', compact('nomorsk', 'opds'));
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
            'status' => ['required', Rule::in(['proses', 'bon', 'selesai'])],
        ];

        // Jika status adalah 'bon', field bon menjadi wajib diisi.
        if ($request->input('status') == 'bon') {
            $rules['namabon'] = 'required|string|max:50';
            $rules['tglbon'] = 'required|date';
            $rules['alasanbonsk'] = 'required|string|max:255';
        }

        $validatedData = $request->validate($rules);
        $dataToUpdate = $validatedData;

        // Jika status BUKAN 'bon', pastikan semua data bon di-set null.
        if ($validatedData['status'] != 'bon') {
            $dataToUpdate['namabon'] = null;
            $dataToUpdate['tglbon'] = null;
            $dataToUpdate['alasanbonsk'] = null;
        }

        $nomorsk->update($dataToUpdate);

        return redirect()->route('admin.nomorsk.index')->with('success', 'Nomor SK berhasil diperbarui.');
    }

    public function destroy(NomorSk $nomorsk)
    {
        $nomorsk->delete();
        return redirect()->route('admin.nomorsk.index')->with('success', 'Nomor SK berhasil dihapus.');
    }
}