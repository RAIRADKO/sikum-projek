<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OpdController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// --- GRUP ROUTE UNTUK TAMU (TIDAK TEROTENTIKASI) ---
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

// --- GRUP ROUTE UNTUK PENGGUNA TEROTENTIKASI ---
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});


// --- GRUP ROUTE UNTUK ADMIN ---
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Rute untuk Manajemen OPD
    Route::resource('opd', OpdController::class);

    // Rute untuk Manajemen User
    Route::resource('user', UserController::class);
});


// Hanya untuk development - membuat admin
if (app()->environment('local')) {
    Route::get('/create-admin-dev', [AdminController::class, 'createAdmin']);
}

Route::get('/user/sk', function () {
    return view('sk');
})->name('sk');

Route::get('/user/perbup', function () {
    return view('perbup');
})->name('perbup');