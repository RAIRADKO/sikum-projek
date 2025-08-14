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

        // Ambil data berdasarkan jenis dokumen dengan relasi OPD
        if ($jenis_dokumen == 'semua' || $jenis_dokumen == 'nomor_sk') {
            $data['nomor_sk'] = NomorSk::with('opd')
                ->whereYear('tglsk', $tahun)
                ->orderBy('nosk', 'asc')
                ->get();
        }
        
        if ($jenis_dokumen == 'semua' || $jenis_dokumen == 'nomor_perbup') {
            $data['nomor_perbup'] = NomorPerbup::with(['opd', 'seri'])
                ->whereYear('tglpb', $tahun)
                ->orderBy('nopb', 'asc')
                ->get();
        }
        
        if ($jenis_dokumen == 'semua' || $jenis_dokumen == 'sk_lainnya') {
            $data['sk_lainnya'] = ProsesLain::with(['opd', 'asisten'])
                ->whereYear('tglmasuk', $tahun)
                ->orderBy('tglmasuk', 'desc')
                ->get();
        }

        if ($format == 'pdf') {
            $pdf = PDF::loadView('cetak.laporan', $data)
                ->setPaper('a4', 'landscape') // Set landscape untuk tabel yang lebar
                ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);
            
            $filename = 'laporan-' . $jenis_dokumen . '-' . $tahun . '.pdf';
            return $pdf->stream($filename);
            
        } elseif ($format == 'excel') {
            return Excel::download(
                new LaporanExport($data), 
                'laporan-' . $jenis_dokumen . '-' . $tahun . '.xlsx'
            );
        }

        return redirect()->back()->with('error', 'Format tidak valid.');
    }

    /**
     * Cetak laporan individual berdasarkan jenis dokumen
     */
    public function cetakIndividual(Request $request, $jenis, $id)
    {
        $format = $request->input('format', 'pdf');
        
        switch ($jenis) {
            case 'sk':
                $data = NomorSk::with('opd')->findOrFail($id);
                $view = 'cetak.sk_individual';
                $filename = 'sk-' . $data->nosk;
                break;
                
            case 'perbup':
                $data = NomorPerbup::with(['opd', 'seri'])->findOrFail($id);
                $view = 'cetak.perbup_individual';
                $filename = 'perbup-' . $data->nopb;
                break;
                
            case 'sk-lainnya':
                $data = ProsesLain::with(['opd', 'asisten'])->findOrFail($id);
                $view = 'cetak.sk_lainnya_individual';
                $filename = 'sk-lainnya-' . $data->kodelain;
                break;
                
            default:
                return redirect()->back()->with('error', 'Jenis dokumen tidak valid.');
        }

        if ($format == 'pdf') {
            $pdf = PDF::loadView($view, compact('data'))
                ->setPaper('a4', 'portrait');
            return $pdf->stream($filename . '.pdf');
        }

        return redirect()->back()->with('error', 'Format tidak didukung untuk cetak individual.');
    }
}