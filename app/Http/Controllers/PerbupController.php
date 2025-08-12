<?php

namespace App\Http\Controllers;

use App\Models\NomorPerbup;
use App\Models\ProsesPerbup;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PerbupController extends Controller
{
    /**
     * Menampilkan halaman utama dengan pilihan tahun.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $years = range(date('Y'), 2021);
        return view('user.perbup', compact('years'));
    }

    /**
     * Menampilkan data Peraturan Bupati berdasarkan tahun dan pencarian.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $year
     * @return \Illuminate\View\View
     */
    public function showByYear(Request $request, $year): View
    {
        $search = $request->input('search');

        $perbupDataQuery = NomorPerbup::whereYear('tglpb', $year)
                                    ->with('opd') // Eager load relasi OPD
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

    /**
     * Menampilkan halaman detail untuk satu Peraturan Bupati.
     *
     * @param  \App\Models\NomorPerbup  $nomorperbup
     * @return \Illuminate\View\View
     */
    public function show(NomorPerbup $nomorperbup): View
    {
        // Menggunakan Route Model Binding untuk mengambil data
        // dan mengirimkannya ke view 'user.perbup_detail'
        return view('user.perbup_detail', ['perbup' => $nomorperbup]);
    }

    /**
     * Menampilkan halaman utama untuk data PB yang masih dalam proses.
     *
     * @return \Illuminate\View\View
     */
    public function prosesIndex(): View
    {
        $years = range(date('Y'), 2021);
        return view('user.perbup_proses', compact('years'));
    }

    /**
     * Menampilkan data PB dalam proses berdasarkan tahun dan pencarian.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $year
     * @return \Illuminate\View\View
     */
    public function prosesShowByYear(Request $request, $year): View
    {
        $search = $request->input('search');

        $prosesPerbupDataQuery = ProsesPerbup::whereYear('tglmasukpb', $year)
                                             ->with('opd')
                                             ->orderBy('tglmasukpb', 'desc');

        if ($search) {
            $prosesPerbupDataQuery->where(function ($query) use ($search) {
                $query->where('judulpb', 'like', "%{$search}%")
                      ->orWhere('kodepb', 'like', "%{$search}%")
                      ->orWhereHas('opd', function ($q) use ($search) {
                          $q->where('namaopd', 'like', "%{$search}%");
                      });
            });
        }

        $prosesPerbupData = $prosesPerbupDataQuery->paginate(15)->appends(['search' => $search]);

        return view('user.perbup_proses_data', [
            'year' => $year,
            'prosesPerbupData' => $prosesPerbupData
        ]);
    }
    
    /**
     * Menampilkan detail data proses PB dalam format JSON.
     *
     * @param  mixed  $kodepb
     * @return \Illuminate\Http\JsonResponse
     */
    public function prosesShow(ProsesPerbup $prosesperbup): View
    {
        // Eager load relasi untuk menghindari N+1 query problem
        $prosesperbup->load(['opd', 'nomorPerbup']);

        return view('user.perbup_proses_detail', ['prosesPerbup' => $prosesperbup]);
    }

    /**
     * Menampilkan halaman cetak untuk satu Peraturan Bupati.
     *
     * @param  mixed  $id
     * @return \Illuminate\View\View
     */
    public function cetak($id): View
    {
        $perbup = NomorPerbup::findOrFail($id);
        return view('user.perbup_cetak', ['perbup' => $perbup]);
    }
}