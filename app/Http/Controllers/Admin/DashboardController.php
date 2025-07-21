<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalUsers' => User::count(),
            'totalOpds' => Opd::count(),
            'todayActivities' => 15, // Contoh statis, bisa diganti dengan query database
            'pendingRequests' => 3,  // Contoh statis, bisa diganti dengan query database
            'recentUsers' => User::with('opd')
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get()
        ];

        return view('admin.dashboard', $data);
    }
}