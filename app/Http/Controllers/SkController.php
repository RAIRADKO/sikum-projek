<?php

namespace App\Http\Controllers;

use App\Models\NomorSk;
use App\Models\ProsesSk;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SkController extends Controller
{
    /**
     * Menampilkan data SK berdasarkan tahun yang diberikan.
     *
     * @param  int  $year
     * @return \Illuminate\View\View
     */
    public function showByYear(Request $request, $year)
    {
        $search = $request->input('search');

        $skDataQuery = \App\Models\NomorSk::whereYear('tglsk', $year)
                                    ->with('opd')
                                    ->orderBy('tglsk', 'desc');

        if ($search) {
            $skDataQuery->where(function ($query) use ($search) {
                $query->where('judulsk', 'like', "%{$search}%")
                      ->orWhereHas('opd', function ($q) use ($search) {
                          $q->where('namaopd', 'like', "%{$search}%");
                      });
            });
        }

        $skData = $skDataQuery->paginate(15)->appends(['search' => $search]);

        return view('user.sk_data', [
            'year' => $year,
            'skData' => $skData
        ]);
    }

    public function show(NomorSk $nomorsk)
    {
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
        // Mengurutkan data proses SK dari terbaru ke terlama
        $prosesSkData = \App\Models\ProsesSk::whereYear('tglmasuksk', $year)
                                             ->orderBy('tglmasuksk', 'desc') // Ditambahkan
                                             ->paginate(15);
        return view('user.sk_proses_data', ['year' => $year, 'prosesSkData' => $prosesSkData]);
    }
}