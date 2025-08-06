<?php

namespace App\Http\Controllers;

use App\Models\NomorSk;
use App\Models\ProsesSk;
use App\Models\NotaPengajuanSk;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SkController extends Controller
{
    /**
     * Menampilkan data SK berdasarkan tahun yang diberikan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $year
     * @return \Illuminate\View\View
     */
    public function showByYear(Request $request, $year)
    {
        $search = $request->input('search');

        $skDataQuery = \App\Models\NomorSk::whereYear('tglsk', $year)
                                        ->with('opd')
                                        ->orderBy('tglsk', 'desc');

        if ($search) {
            $skDataQuery->where(function ($query) use ($search) {
                $query->where('judulsk', 'like', "%{$search}%")
                      ->orWhereHas('opd', function ($q) use ($search) {
                          $q->where('namaopd', 'like', "%{$search}%");
                      });
            });
        }

        $skData = $skDataQuery->paginate(15)->appends(['search' => $search]);

        return view('user.sk_data', [
            'year' => $year,
            'skData' => $skData
        ]);
    }

    /**
     * Menampilkan detail SK.
     *
     * @param  \App\Models\NomorSk  $nomorsk
     * @return \Illuminate\View\View
     */
    public function show(NomorSk $nomorsk)
    {
        return view('user.sk_detail', ['sk' => $nomorsk]);
    }

    /**
     * Menampilkan halaman utama SK.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $years = range(date('Y'), 2021);
        return view('user.sk', compact('years'));
    }

    /**
     * Menampilkan halaman utama proses SK.
     *
     * @return \Illuminate\View\View
     */
    public function prosesIndex()
    {
        $years = range(date('Y'), 2021);
        return view('user.sk_proses', compact('years'));
    }

    /**
     * Menampilkan data proses SK berdasarkan tahun.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $year
     * @return \Illuminate\View\View
     */
    public function prosesShowByYear(Request $request, $year)
    {
        $search = $request->input('search');

        $prosesSkDataQuery = \App\Models\ProsesSk::whereYear('tglmasuksk', $year)
                                              ->with(['opd', 'nomorSk'])
                                              ->orderBy('tglmasuksk', 'desc');

        if ($search) {
            $prosesSkDataQuery->where(function ($query) use ($search) {
                $query->where('judulsk', 'like', "%{$search}%")
                      ->orWhere('kodesk', 'like', "%{$search}%")
                      ->orWhereHas('opd', function ($q) use ($search) {
                          $q->where('namaopd', 'like', "%{$search}%");
                      });
            });
        }

        $prosesSkData = $prosesSkDataQuery->paginate(15)->appends(['search' => $search]);

        return view('user.sk_proses_data', [
            'year' => $year, 
            'prosesSkData' => $prosesSkData
        ]);
    }

    /**
     * Menampilkan detail proses SK.
     *
     * @param  string  $kodesk
     * @return \Illuminate\View\View
     */
    public function prosesShow($kodesk)
    {
        $prosesSk = ProsesSk::with(['opd', 'nomorSk'])->findOrFail($kodesk);
        
        return view('user.sk_proses_detail', ['prosesSk' => $prosesSk]);
    }

    /**
     * Menampilkan halaman Nota Pengajuan SK.
     * Jika nota belum ada, akan membuat instance baru dengan data default.
     *
     * @param  string  $kodesk
     * @return \Illuminate\View\View
     */
    public function notaPengajuan($kodesk)
    {
        // Ambil data proses SK dengan relasi yang diperlukan
        $prosesSk = ProsesSk::with([
            'opd', 
            'asisten', 
            'nomorSk', 
            'notaPengajuan'
        ])->findOrFail($kodesk);
        
        // Ambil atau buat data nota pengajuan
        $notaPengajuan = $prosesSk->notaPengajuan;
        
        // Jika belum ada data nota pengajuan, buat instance baru dengan default values
        if (!$notaPengajuan) {
            $notaPengajuan = new NotaPengajuanSk([
                'kodesk' => $kodesk,
                'ditujukan_kepada' => 'Bupati Purworejo',
                'melalui' => 'Wakil Bupati Purworejo',
                'dari' => 'Bagian Hukum Setda Kab. Purworejo',
                'perihal' => 'Keputusan Bupati Purworejo tentang',
                'mohon_untuk' => 'Tapak Asman',
                'tempat_tanggal' => 'Purworejo, ' . Carbon::now()->translatedFormat('j F Y'),
                'jabatan_penandatangan' => 'KEPALA BAGIAN HUKUM',
                'instansi_penandatangan' => 'SETDA KABUPATEN PURWOREJO',
                'nama_penandatangan' => 'PUGUH TRIHATMOKO, SH, MH',
                'pangkat_penandatangan' => 'Pembina Tk I',
                'nip_penandatangan' => 'NIP. 19750829 199903 1 005',
            ]);
        }
        
        return view('user.nota_pengajuan', compact('prosesSk', 'notaPengajuan'));
    }
}
