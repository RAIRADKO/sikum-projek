<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OpdController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController; // <--- UBAH BARIS INI
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkController;
use App\Http\Controllers\PerbupController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rute Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute Autentikasi
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Rute untuk Pengguna yang Terautentikasi
// Rute untuk Pengguna yang Terautentikasi
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // SK Routes
    Route::get('/sk', [SkController::class, 'index'])->name('sk');
    Route::get('/sk/{year}', [SkController::class, 'showByYear'])->name('sk.year');
    Route::get('/sk-proses', [SkController::class, 'prosesIndex'])->name('sk-proses');
    Route::get('/sk-proses/{year}', [SkController::class, 'prosesShowByYear'])->name('sk-proses.year');

    // Perbup Routes
    Route::get('/perbup', [PerbupController::class, 'index'])->name('perbup');
    Route::get('/perbup/{year}', [PerbupController::class, 'showByYear'])->name('perbup.year');
    Route::get('/perbup-proses', [PerbupController::class, 'prosesIndex'])->name('perbup-proses');
    Route::get('/perbup-proses/{year}', [PerbupController::class, 'prosesShowByYear'])->name('perbup-proses.year');

    Route::redirect('/profile', '/dashboard')->name('profile');
});


// Rute untuk Admin
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute untuk Manajemen User (Digabungkan)
    //Route::patch('user/{user}/approve', [UserController::class, 'approve'])->name('user.approve');
    //Route::delete('user/{user}/reject', [UserController::class, 'reject'])->name('user.reject');
    Route::resource('user', UserController::class);

    // Rute untuk Manajemen OPD
    Route::resource('opd', OpdController::class);

    // Rute untuk Manajemen Admin
    Route::resource('admin', AdminController::class); // <--- UBAH BARIS INI
});