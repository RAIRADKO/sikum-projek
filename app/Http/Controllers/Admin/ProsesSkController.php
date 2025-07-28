<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProsesSk;
use App\Models\Opd;
use App\Models\Asisten;
use Illuminate\Http\Request;

class ProsesSkController extends Controller
{
    public function index()
    {
        $prosesSks = ProsesSk::with('opd')->orderBy('tglmasuksk', 'desc')->paginate(10);
        return view('admin.prosessk.index', compact('prosesSks'));
    }

    public function create()
    {
        $opds = Opd::all();
        $asistens = Asisten::all();
        return view('admin.prosessk.create', compact('opds', 'asistens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodesk' => 'required|string|max:10|unique:prosessk',
            'tglmasuksk' => 'required|date',
            'judulsk' => 'required|string',
            'kodeopd' => 'required|string|exists:opds,kodeopd',
            'kodeass' => 'required|string|exists:asisten,kodeass',
        ]);

        ProsesSk::create($request->all());

        return redirect()->route('admin.prosessk.index')->with('success', 'Proses SK berhasil ditambahkan.');
    }

    public function edit(ProsesSk $prosessk)
    {
        $opds = Opd::all();
        $asistens = Asisten::all();
        return view('admin.prosessk.edit', compact('prosessk', 'opds', 'asistens'));
    }

    public function update(Request $request, ProsesSk $prosessk)
    {
        $request->validate([
            'tglmasuksk' => 'required|date',
            'judulsk' => 'required|string',
            'kodeopd' => 'required|string|exists:opds,kodeopd',
            'kodeass' => 'required|string|exists:asisten,kodeass',
        ]);

        $prosessk->update($request->all());

        return redirect()->route('admin.prosessk.index')->with('success', 'Proses SK berhasil diperbarui.');
    }

    public function destroy(ProsesSk $prosessk)
    {
        $prosessk->delete();
        return redirect()->route('admin.prosessk.index')->with('success', 'Proses SK berhasil dihapus.');
    }
}