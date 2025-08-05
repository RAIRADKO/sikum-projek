<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProsesSk;
use App\Models\Opd;
use App\Models\Asisten;
use App\Models\NomorSk;
use App\Models\NotaPengajuanSk; 
use Illuminate\Http\Request;

class ProsesSkController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $prosesSks = ProsesSk::with(['opd', 'nomorSk'])
            ->when($search, function ($query, $search) {
                return $query->where('kodesk', 'like', "%{$search}%")
                             ->orWhere('judulsk', 'like', "%{$search}%")
                             ->orWhere('nosk', 'like', "%{$search}%")
                             ->orWhereHas('opd', function ($q) use ($search) {
                                 $q->where('namaopd', 'like', "%{$search}%");
                             })
                             ->orWhereHas('nomorSk', function ($q) use ($search) {
                                 $q->where('judulsk', 'like', "%{$search}%");
                             });
            })
            ->orderBy('tglmasuksk', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('admin.prosessk.index', compact('prosesSks'));
    }

    public function create()
    {
        $opds = Opd::all();
        $asistens = Asisten::all();
        // Ambil semua nomor SK yang tersedia untuk dipilih
        $nomorSks = NomorSk::orderBy('nosk', 'desc')->get();
        
        return view('admin.prosessk.create', compact('opds', 'asistens', 'nomorSks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodesk' => 'required|string|max:10|unique:prosessk',
            'tglmasuksk' => 'required|date',
            'judulsk' => 'required|string',
            'kodeopd' => 'required|string|exists:opds,kodeopd',
            'kodeass' => 'required|string|exists:asisten,kodeass',
            'nosk' => 'nullable|exists:nomorsk,nosk', // Validasi nomor SK
        ]);

        $data = $request->all();
        $data['status'] = 'Proses';

        ProsesSk::create($data);

        return redirect()->route('admin.prosessk.index')->with('success', 'Proses SK berhasil ditambahkan.');
    }

    public function edit(ProsesSk $prosessk)
    {
        $opds = Opd::all();
        $asistens = Asisten::all();
        // Ambil semua nomor SK yang tersedia untuk dipilih
        $nomorSks = NomorSk::orderBy('nosk', 'desc')->get();
        
        return view('admin.prosessk.edit', compact('prosessk', 'opds', 'asistens', 'nomorSks'));
    }

    public function update(Request $request, ProsesSk $prosessk)
    {
        $request->validate([
            'tglmasuksk' => 'required|date',
            'judulsk' => 'required|string',
            'kodeopd' => 'required|string|exists:opds,kodeopd',
            'kodeass' => 'required|string|exists:asisten,kodeass',
            'status' => 'required|in:Proses,Selesai',
            'nosk' => 'nullable|exists:nomorsk,nosk', // Validasi nomor SK
            // Tambahkan validasi untuk field lainnya
            'jmlttdsk' => 'nullable|integer',
            'tglnaikkabag' => 'nullable|date',
            'tglnaikass' => 'nullable|date',
            'tglturunsk' => 'nullable|date',
            'ketprosessk' => 'nullable|string',
            'nowa' => 'nullable|string',
        ]);

        $prosessk->update($request->all());

        if ($request->status == 'Selesai') {
            $notaPengajuanData = $request->only([
                'ditujukan_kepada',
                'melalui',
                'lewat',
                'dari',
                'perihal',
                'mohon_untuk',
                'tanda_tangan',
                'lain_lain',
                'tempat_tanggal',
                'jabatan_penandatangan',
                'instansi_penandatangan',
                'nama_penandatangan',
                'pangkat_penandatangan',
                'nip_penandatangan',
            ]);
            $notaPengajuanData['kodesk'] = $prosessk->kodesk;

            NotaPengajuanSk::updateOrCreate(
                ['kodesk' => $prosessk->kodesk],
                $notaPengajuanData
            );
        }

        return redirect()->route('admin.prosessk.index')->with('success', 'Proses SK berhasil diperbarui.');
    }

    public function destroy(ProsesSk $prosessk)
    {
        $prosessk->delete();
        return redirect()->route('admin.prosessk.index')->with('success', 'Proses SK berhasil dihapus.');
    }
}