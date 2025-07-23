<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkController extends Controller
{
    public function index()
    {
        $years = range(date('Y'), 2021);
        return view('user.sk', compact('years'));
    }

    public function showByYear($year)
    {
        // Logika untuk menampilkan data SK berdasarkan tahun
        return view('user.sk_data', ['year' => $year]);
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