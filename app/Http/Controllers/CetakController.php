<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NomorSk;
use App\Models\NomorPerbup;
use App\Models\ProsesLain;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class CetakController extends Controller
{
    public function cetak(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        $format = $request->input('format', 'pdf');
        $jenis_dokumen = $request->input('jenis_dokumen', 'semua');

        $data = [
            'tahun' => $tahun,
            'jenis_dokumen' => $jenis_dokumen,
        ];

        if ($jenis_dokumen == 'semua' || $jenis_dokumen == 'nomor_sk') {
            $data['nomor_sk'] = NomorSk::whereYear('tglsk', $tahun)->get();
        }
        if ($jenis_dokumen == 'semua' || $jenis_dokumen == 'nomor_perbup') {
            $data['nomor_perbup'] = NomorPerbup::whereYear('tglpb', $tahun)->get();
        }
        if ($jenis_dokumen == 'semua' || $jenis_dokumen == 'sk_lainnya') {
            $data['sk_lainnya'] = ProsesLain::whereYear('tglmasuk', $tahun)->get();
        }

        if ($format == 'pdf') {
            $pdf = PDF::loadView('cetak.laporan', $data);
            return $pdf->stream('laporan-'.$tahun.'.pdf');
        } elseif ($format == 'excel') {
            // Perlu penyesuaian pada LaporanExport jika ada
            return Excel::download(new LaporanExport($data), 'laporan-'.$tahun.'.xlsx');
        }

        return redirect()->back()->with('error', 'Format tidak valid.');
    }
}