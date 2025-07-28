<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asisten;
use Illuminate\Http\Request;

class AsistenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asisten = Asisten::all();
        return view('admin.asisten.index', compact('asisten'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.asisten.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:asisten',
            'jabatan' => 'required',
        ]);

        Asisten::create($request->all());

        return redirect()->route('admin.asisten.index')
                        ->with('success','Asisten created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asisten  $asisten
     * @return \Illuminate\Http\Response
     */
    public function edit(Asisten $asisten)
    {
        return view('admin.asisten.edit', compact('asisten'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asisten  $asisten
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asisten $asisten)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:asisten,nim,'.$asisten->id,
            'jabatan' => 'required',
        ]);

        $asisten->update($request->all());

        return redirect()->route('admin.asisten.index')
                        ->with('success','Asisten updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asisten  $asisten
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asisten $asisten)
    {
        $asisten->delete();

        return redirect()->route('admin.asisten.index')
                        ->with('success','Asisten deleted successfully');
    }
}