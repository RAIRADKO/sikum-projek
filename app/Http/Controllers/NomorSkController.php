<?php

// app/Http/Controllers/NomorSkController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NomorSk; // Pastikan Anda mengimpor model NomorSk

class NomorSkController extends Controller
{
    /**
     * Menampilkan daftar Nomor SK berdasarkan tahun.
     *
     * @param  int  $year
     * @return \Illuminate\View\View
     */
    public function index($year)
    {
        // Mengambil data SK dari database, di-filter berdasarkan tahun dari kolom 'tglsk'
        // Data diurutkan dari yang terbaru dan di-paginate (10 data per halaman)
        $nomorSk = NomorSk::whereYear('tglsk', $year)
                          ->orderBy('tglsk', 'desc')
                          ->paginate(10);

        // Mengirimkan data '$nomorSk' dan '$year' ke view 'sk_data'
        return view('sk_data', [
            'nomorSk' => $nomorSk,
            'year' => $year
        ]);
    }
}