<?php

namespace App\Http\Controllers;

use App\Models\NomorPerbup;
use App\Models\ProsesPerbup;
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

    public function show(NomorPerbup $nomorperbup)
    {
        return response()->json($nomorperbup->load('opd'));
    }

    public function prosesIndex()
    {
        $years = range(date('Y'), 2021);
        return view('user.perbup_proses', compact('years'));
    }

    public function prosesShowByYear(Request $request, $year)
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

    // Tambahkan method untuk detail proses perbup
    public function prosesShow($kodepb)
    {
        $prosesPerbup = ProsesPerbup::with('opd')->findOrFail($kodepb);
        return response()->json($prosesPerbup);
    }
}