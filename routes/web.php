<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Rute Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// --- GRUP ROUTE UNTUK TAMU (GUEST) ---
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']); // Action untuk form login
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

// --- GRUP ROUTE UNTUK PENGGUNA TEROTENTIKASI (AUTH) ---
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});


// --- GRUP ROUTE UNTUK ADMIN ---
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Tambahkan route admin lainnya di sini
});


// Hanya untuk development - membuat admin
if (app()->environment('local')) {
    Route::get('/create-admin', [AdminController::class, 'createAdmin']);
}