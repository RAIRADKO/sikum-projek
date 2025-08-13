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

        $data = [
            'nomor_sk' => NomorSk::whereYear('tglsk', $tahun)->get(),
            'nomor_perbup' => NomorPerbup::whereYear('tglpb', $tahun)->get(),
            'sk_lainnya' => ProsesLain::whereYear('tglmasuk', $tahun)->get(),
            'tahun' => $tahun,
        ];

        if ($format == 'pdf') {
            $pdf = PDF::loadView('cetak.laporan', $data);
            return $pdf->stream('laporan-'.$tahun.'.pdf');
        } elseif ($format == 'excel') {
            return Excel::download(new LaporanExport($data), 'laporan-'.$tahun.'.xlsx');
        }

        return redirect()->back()->with('error', 'Format tidak valid.');
    }
}