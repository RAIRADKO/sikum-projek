<?php

namespace App\Http\Controllers;

use App\Models\NomorSk; // Pastikan model ini sudah ada
use Illuminate\Http\Request;
use Carbon\Carbon; // Digunakan untuk memanipulasi tanggal jika diperlukan

class SkController extends Controller
{
    /**
     * Menampilkan data SK berdasarkan tahun yang diberikan.
     *
     * @param  int  $year
     * @return \Illuminate\View\View
     */
    public function showByYear(Request $request, $year) // Tambahkan Request $request
    {
        $search = $request->input('search');

        $skDataQuery = \App\Models\NomorSk::whereYear('tglsk', $year)
                                    ->with('opd') // Eager load relasi OPD
                                    ->orderBy('tglsk', 'desc');

        if ($search) {
            $skDataQuery->where(function ($query) use ($search) {
                $query->where('judulsk', 'like', "%{$search}%")
                      ->orWhereHas('opd', function ($q) use ($search) {
                          $q->where('namaopd', 'like', "%{$search}%");
                      });
            });
        }

        $skData = $skDataQuery->paginate(15)->appends(['search' => $search]); // Misalnya 15 data per halaman

        return view('user.sk_data', [
            'year' => $year,
            'skData' => $skData
        ]);
    }
    public function show(NomorSk $nomorsk)
    {
        // Variabel $nomorsk sudah berisi data SK yang cocok dengan ID dari URL
        // Kita hanya perlu mengirimkannya ke view
        return view('user.sk_detail', ['sk' => $nomorsk]);
    }

    public function index()
    {
        $years = range(date('Y'), 2021);
        return view('user.sk', compact('years'));
    }

    public function prosesIndex()
    {
        $years = range(date('Y'), 2021);
        return view('user.sk_proses', compact('years'));
    }

    public function prosesShowByYear($year)
    {
        // Logika untuk menampilkan data proses SK berdasarkan tahun
        return view('user.sk_proses_data', ['year' => $year]);
    }
}