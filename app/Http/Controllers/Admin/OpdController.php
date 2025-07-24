<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use App\Models\Asisten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OpdController extends Controller
{
    public function index()
    {
        $opds = Opd::with('asisten')->orderBy('namaopd')->paginate(10);
        return view('admin.opd.index', compact('opds'));
    }

    public function create()
    {
        $asistens = Asisten::all();
        return view('admin.opd.create', compact('asistens'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namaopd' => ['required', 'string', 'max:255', 'unique:opds'],
            'kodeass' => ['required', 'string', 'exists:asisten,kodeass'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.opd.create')
                ->withErrors($validator)
                ->withInput();
        }

        Opd::create($request->all());

        return redirect()->route('admin.opd.index')->with('success', 'OPD berhasil ditambahkan.');
    }

    public function edit(Opd $opd)
    {
        $asistens = Asisten::all();
        return view('admin.opd.edit', compact('opd', 'asistens'));
    }

    public function update(Request $request, Opd $opd)
    {
        $validator = Validator::make($request->all(), [
            'namaopd' => ['required', 'string', 'max:255', 'unique:opds,namaopd,' . $opd->id],
            'kodeass' => ['required', 'string', 'exists:asisten,kodeass'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.opd.edit', $opd)
                ->withErrors($validator)
                ->withInput();
        }

        $opd->update($request->all());

        return redirect()->route('admin.opd.index')->with('success', 'OPD berhasil diperbarui.');
    }

    public function destroy(Opd $opd)
    {
        if ($opd->users()->count() > 0) {
            return redirect()->route('admin.opd.index')->with('error', 'OPD tidak dapat dihapus karena masih memiliki user terdaftar.');
        }

        $opd->delete();

        return redirect()->route('admin.opd.index')->with('success', 'OPD berhasil dihapus.');
    }
}