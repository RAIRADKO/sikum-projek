<?php

namespace App\Http\Controllers;

use App\Models\Asisten;
use Illuminate\Http\Request;

class AsistenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $asistens = Asisten::orderBy('kodeass')->paginate(10);
        return view('user.asisten', compact('asistens'));
    }
}