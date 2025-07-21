<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalOpds = Opd::count();
        
        // Contoh data dinamis, bisa disesuaikan
        $todayActivities = 0; // Ganti dengan query log aktivitas jika ada
        $pendingRequests = 0; // Ganti dengan query request yang pending

        $recentUsers = User::with('opd')
            ->latest()
            ->take(5)
            ->get();

        $opdDistribution = User::select('opd_id', DB::raw('count(*) as total'))
            ->groupBy('opd_id')
            ->with('opd')
            ->get();

        $userRegistrationData = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $data = [
            'totalUsers' => $totalUsers,
            'totalOpds' => $totalOpds,
            'todayActivities' => $todayActivities,
            'pendingRequests' => $pendingRequests,
            'recentUsers' => $recentUsers,
            'opdDistribution' => $opdDistribution,
            'userRegistrationData' => $userRegistrationData
        ];

        return view('admin.dashboard', $data);
    }
}