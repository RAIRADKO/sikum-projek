<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OpdController;
use App\Http\Controllers\Admin\UserController;

// Rute Halaman Depan
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute Autentikasi
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk Admin
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Rute untuk Manajemen User
    Route::get('user/pending', [UserController::class, 'pending'])->name('user.pending');
    Route::patch('user/{user}/approve', [UserController::class, 'approve'])->name('user.approve');
    Route::delete('user/{user}/reject', [UserController::class, 'reject'])->name('user.reject');
    Route::resource('user', UserController::class);

    // Rute untuk Manajemen OPD
    Route::resource('opd', OpdController::class);
});