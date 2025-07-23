<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerbupController extends Controller
{
    public function index()
    {
        $years = range(date('Y'), 2021);
        return view('user.perbup', compact('years'));
    }

    public function showByYear($year)
    {
        // Logika untuk menampilkan data Perbup berdasarkan tahun
        return view('user.perbup_data', ['year' => $year]);
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