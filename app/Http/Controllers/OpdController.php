<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $opds = Opd::with('asisten')->orderBy('namaopd')->paginate(10);
        return view('user.opd', compact('opds'));
    }
}