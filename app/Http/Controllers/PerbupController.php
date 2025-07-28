<?php

namespace App\Http\Controllers;

use App\Models\NomorPerbup; // Tambahkan ini
use Illuminate\Http\Request;

class PerbupController extends Controller
{
    public function index()
    {
        $years = range(date('Y'), 2021);
        return view('user.perbup', compact('years'));
    }

    public function showByYear(Request $request, $year)
    {
        $search = $request->input('search');

        $perbupDataQuery = NomorPerbup::whereYear('tglpb', $year)
                                    ->with('opd')
                                    ->orderBy('tglpb', 'desc');

        if ($search) {
            $perbupDataQuery->where(function ($query) use ($search) {
                $query->where('judulpb', 'like', "%{$search}%")
                      ->orWhere('nopb', 'like', "%{$search}%")
                      ->orWhereHas('opd', function ($q) use ($search) {
                          $q->where('namaopd', 'like', "%{$search}%");
                      });
            });
        }

        $perbupData = $perbupDataQuery->paginate(15)->appends(['search' => $search]);

        return view('user.perbup_data', [
            'year' => $year,
            'perbupData' => $perbupData
        ]);
    }
    
    // Tambahkan method baru untuk detail
    public function show(NomorPerbup $nomorperbup)
    {
        // Anda perlu membuat view 'user.perbup_detail'
        // Untuk sekarang kita akan redirect atau tampilkan data mentah
        // return view('user.perbup_detail', ['perbup' => $nomorperbup]);
        
        // Contoh response data mentah:
        return response()->json($nomorperbup->load('opd'));
    }


    public function prosesIndex()
    {
        $years = range(date('Y'), 2021);
        return view('user.perbup_proses', compact('years'));
    }

    public function prosesShowByYear($year)
    {
        // Logika untuk menampilkan data proses Perbup berdasarkan tahun
        return view('user.perbup_proses_data', ['year' => $year]);
    }
}