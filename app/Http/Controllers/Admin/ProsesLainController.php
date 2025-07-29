<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProsesLain;
use App\Models\Opd;
use App\Models\Asisten;
use Illuminate\Http\Request;

class ProsesLainController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $prosesLain = ProsesLain::with(['opd', 'asisten'])
            ->when($search, function ($query, $search) {
                return $query->where('kodelain', 'like', "%{$search}%")
                             ->orWhere('judul', 'like', "%{$search}%")
                             ->orWhereHas('opd', function ($q) use ($search) {
                                 $q->where('namaopd', 'like', "%{$search}%");
                             });
            })
            ->orderBy('tglmasuk', 'desc')
            ->paginate(10);
        return view('admin.proseslain.index', compact('prosesLain'));
    }

    public function create()
    {
        $opds = Opd::all();
        $asistens = Asisten::all();
        return view('admin.proseslain.create', compact('opds', 'asistens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodelain' => 'required|string|max:10|unique:proseslain',
            'tglmasuk' => 'required|date',
            'judul' => 'required|string',
            'kodeopd' => 'required|string|exists:opds,kodeopd',
            'kodeass' => 'required|string|exists:asisten,kodeass',
        ]);

        $data = $request->all();
        $data['status'] = 'Diproses'; // Set status default

        ProsesLain::create($data);

        return redirect()->route('admin.proseslain.index')->with('success', 'Data SK Lainnya berhasil ditambahkan.');
    }


    public function edit(ProsesLain $proseslain)
    {
        $opds = Opd::all();
        $asistens = Asisten::all();
        return view('admin.proseslain.edit', compact('proseslain', 'opds', 'asistens'));
    }

    public function update(Request $request, ProsesLain $proseslain)
    {
        $request->validate([
            'tglmasuk' => 'required|date',
            'judul' => 'required|string',
            'status' => 'required|string|in:Diproses,Selesai', // Tambahkan validasi status
            'kodeopd' => 'required|string|exists:opds,kodeopd',
            'kodeass' => 'required|string|exists:asisten,kodeass',
        ]);

        $proseslain->update($request->all());

        return redirect()->route('admin.proseslain.index')->with('success', 'Data SK Lainnya berhasil diperbarui.');
    }

    public function destroy(ProsesLain $proseslain)
    {
        $proseslain->delete();
        return redirect()->route('admin.proseslain.index')->with('success', 'Data SK Lainnya berhasil dihapus.');
    }
}