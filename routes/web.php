<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;

// Pastikan route user.dashboard tersedia sebelum redirect
Route::get('/user/dashboard', function () {
    return view('dashboard');
})->name('user.dashboard')->middleware('auth:web');

// Public Routes
Route::get('/', function () {
    if (auth('web')->check()) {
        return redirect()->route('user.dashboard');
    }
    return app(\App\Http\Controllers\HomeController::class)->index();
})->name('home');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Tambahkan route admin lainnya di sini
});

// User-only Routes
Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Simple dashboard route for user (alternative)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// Development only - create admin
if (app()->environment('local')) {
    Route::get('/create-admin', [AdminController::class, 'createAdmin']);
}