<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProsesPerbup;
use App\Models\Opd;
use Illuminate\Http\Request;

class ProsesPerbupController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $prosesPerbup = ProsesPerbup::with('opd')
            ->when($search, function ($query, $search) {
                return $query->where('kodepb', 'like', "%{$search}%")
                             ->orWhere('judulpb', 'like', "%{$search}%")
                             ->orWhereHas('opd', function ($q) use ($search) {
                                 $q->where('namaopd', 'like', "%{$search}%");
                             });
            })
            ->orderBy('tglmasukpb', 'desc')
            ->paginate(10);
        return view('admin.prosesperbup.index', compact('prosesPerbup'));
    }

    public function create()
    {
        $opds = Opd::all();
        return view('admin.prosesperbup.create', compact('opds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodepb' => 'required|string|max:10|unique:prosespb',
            'tglmasukpb' => 'required|date',
            'judulpb' => 'required|string',
            'kodeopd' => 'required|string|exists:opds,kodeopd',
        ]);

        $data = $request->all();
        $data['status'] = 'proses';

        ProsesPerbup::create($data);

        return redirect()->route('admin.prosesperbup.index')->with('success', 'Proses Perbup berhasil ditambahkan.');
    }

    public function edit(ProsesPerbup $prosesperbup)
    {
        $opds = Opd::all();
        return view('admin.prosesperbup.edit', compact('prosesperbup', 'opds'));
    }

    public function update(Request $request, ProsesPerbup $prosesperbup)
    {
        $request->validate([
            'tglmasukpb' => 'required|date',
            'judulpb' => 'required|string',
            'kodeopd' => 'required|string|exists:opds,kodeopd',
            'status' => 'required|in:proses,selesai',
        ]);

        $prosesperbup->update($request->all());

        return redirect()->route('admin.prosesperbup.index')->with('success', 'Proses Perbup berhasil diperbarui.');
    }

    public function destroy(ProsesPerbup $prosesperbup)
    {
        $prosesperbup->delete();
        return redirect()->route('admin.prosesperbup.index')->with('success', 'Proses Perbup berhasil dihapus.');
    }
}