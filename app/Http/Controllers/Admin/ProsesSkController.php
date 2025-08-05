<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProsesSk;
use App\Models\Opd;
use App\Models\Asisten;
use App\Models\NotaPengajuanSk; 
use Illuminate\Http\Request;

class ProsesSkController extends Controller
{
    // Ubah metode index menjadi seperti ini
    public function index(Request $request)
    {
        $search = $request->input('search');

        $prosesSks = ProsesSk::with('opd')
            ->when($search, function ($query, $search) {
                return $query->where('kodesk', 'like', "%{$search}%")
                             ->orWhere('judulsk', 'like', "%{$search}%")
                             ->orWhereHas('opd', function ($q) use ($search) {
                                 $q->where('namaopd', 'like', "%{$search}%");
                             });
            })
            ->orderBy('tglmasuksk', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]); // Agar pencarian tetap ada saat pindah halaman

        return view('admin.prosessk.index', compact('prosesSks'));
    }

    public function create()
    {
        $opds = Opd::all();
        $asistens = Asisten::all();
        return view('admin.prosessk.create', compact('opds', 'asistens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodesk' => 'required|string|max:10|unique:prosessk',
            'tglmasuksk' => 'required|date',
            'judulsk' => 'required|string',
            'kodeopd' => 'required|string|exists:opds,kodeopd',
            'kodeass' => 'required|string|exists:asisten,kodeass',
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
        return view('admin.prosessk.edit', compact('prosessk', 'opds', 'asistens'));
    }

    public function update(Request $request, ProsesSk $prosessk)
    {
        $request->validate([
            'tglmasuksk' => 'required|date',
            'judulsk' => 'required|string',
            'kodeopd' => 'required|string|exists:opds,kodeopd',
            'kodeass' => 'required|string|exists:asisten,kodeass',
            'status' => 'required|in:Proses,Selesai',
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