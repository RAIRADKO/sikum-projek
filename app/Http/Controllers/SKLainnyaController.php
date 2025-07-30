<?php

namespace App\Http\Controllers;

use App\Models\ProsesLain;
use Illuminate\Http\Request;

class SKLainnyaController extends Controller
{
    /**
     * Menampilkan halaman pilihan tahun untuk SK Lainnya.
     */
    public function index()
    {
        // Mengambil tahun-tahun unik dari data SK Lainnya
        $years = ProsesLain::selectRaw('YEAR(tglmasuk) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Jika tidak ada data, gunakan rentang tahun default
        if ($years->isEmpty()) {
            $years = range(date('Y'), 2021);
        }
        
        return view('user.sk_lainnya', compact('years'));
    }

    /**
     * Menampilkan data SK Lainnya berdasarkan tahun yang dipilih.
     */
    public function showByYear(Request $request, $year)
    {
        $search = $request->input('search');

        $query = ProsesLain::with(['opd', 'asisten'])
            ->whereYear('tglmasuk', $year)
            ->orderBy('tglmasuk', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kodelain', 'like', "%{$search}%")
                  ->orWhereHas('opd', function ($subq) use ($search) {
                      $subq->where('namaopd', 'like', "%{$search}%");
                  });
            });
        }

        $prosesLainData = $query->paginate(15)->appends(['search' => $search]);

        return view('user.sk_lainnya_data', [
            'year' => $year,
            'prosesLainData' => $prosesLainData
        ]);
    }

    /**
     * Menampilkan detail data SK Lainnya.
     */
    public function show(ProsesLain $proseslain)
    {
        return view('user.sk_lainnya_detail', ['prosesLain' => $proseslain]);
    }
}