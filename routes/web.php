<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OpdController as AdminOpdController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkController;
use App\Http\Controllers\PerbupController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\AsistenController;
use App\Http\Controllers\SKLainnyaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NomorSkController;
use App\Http\Controllers\Admin\ProsesSkController;
use App\Http\Controllers\CetakController;


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
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Profile & Settings Routes
    Route::post('/dashboard/update-profile', [HomeController::class, 'updateProfile'])->name('dashboard.update-profile');
    Route::get('/dashboard/notifications', [HomeController::class, 'getNotifications'])->name('dashboard.notifications');
    Route::post('/dashboard/update-profile', [HomeController::class, 'updateProfile'])->name('dashboard.update-profile');
    Route::get('/cetak', [CetakController::class, 'cetak'])->name('cetak')->middleware('auth');

    // Print Routes
    Route::get('/dashboard/cetak-tahunan', [HomeController::class, 'cetakTahunan'])->name('dashboard.cetak-tahunan');

    // Rute untuk menampilkan data OPD bagi user
    Route::get('/opd', [OpdController::class, 'index'])->name('opd.index');

    // Rute untuk menampilkan data Asisten bagi user
    Route::get('/asisten', [AsistenController::class, 'index'])->name('asisten.index');

    // SK Routes
    Route::get('/sk', [SkController::class, 'index'])->name('sk');
    Route::get('/sk/{year}', [SkController::class, 'showByYear'])->name('sk.year');
    Route::get('/sk/detail/{nomorsk}', [SkController::class, 'show'])->name('sk.detail');
    Route::get('/sk/cetak/{id}', [SkController::class, 'cetak'])->name('sk.cetak');


    // SK Proses Routes
    Route::get('/sk-proses', [SkController::class, 'prosesIndex'])->name('sk-proses');
    Route::get('/sk-proses/{year}', [SkController::class, 'prosesShowByYear'])->name('sk-proses.year');
    Route::get('/sk-proses/detail/{kodesk}', [SkController::class, 'prosesShow'])->name('sk-proses.detail');

    // Route untuk Nota Pengajuan SK (untuk user)
    Route::get('/sk-proses/nota-pengajuan/{kodesk}', [App\Http\Controllers\SkController::class, 'notaPengajuan'])
        ->name('sk-proses.nota-pengajuan')
        ->middleware('auth');

    // Perbup Routes
    Route::get('/perbup', [PerbupController::class, 'index'])->name('perbup');
    Route::get('/perbup/{year}', [PerbupController::class, 'showByYear'])->name('perbup.year');
    Route::get('/perbup/detail/{nomorperbup}', [PerbupController::class, 'show'])->name('perbup.detail');
    Route::get('/perbup/cetak/{id}', [PerbupController::class, 'cetak'])->name('perbup.cetak')->middleware('auth');

    // Perbup Proses Routes
    Route::get('/perbup-proses', [PerbupController::class, 'prosesIndex'])->name('perbup-proses');
    Route::get('/perbup-proses/{year}', [PerbupController::class, 'prosesShowByYear'])->name('perbup-proses.year');
    Route::get('/perbup-proses/detail/{prosesperbup}', [PerbupController::class, 'prosesShow'])->name('perbup-proses.detail');

    // SK Lainnya Routes
    Route::get('/sk-lainnya', [SKLainnyaController::class, 'index'])->name('sk-lainnya.index');
    Route::get('/sk-lainnya/{year}', [SKLainnyaController::class, 'showByYear'])->name('sk-lainnya.year');
    Route::get('/sk-lainnya/detail/{proseslain}', [SKLainnyaController::class, 'show'])->name('sk-lainnya.detail');
    Route::get('/sk-lainnya/cetak/{id}', [SKLainnyaController::class, 'cetak'])->name('sk-lainnya.cetak');


    Route::redirect('/profile', '/dashboard')->name('profile');
});

// Rute untuk Admin
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute hanya untuk Super Admin
    Route::middleware(['role:superadmin'])->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('admin', AdminController::class);
    });

    // Rute untuk Super Admin dan Admin
    Route::resource('opd', AdminOpdController::class);
    Route::resource('asisten', \App\Http\Controllers\Admin\AsistenController::class)->except(['show']);
    Route::resource('nomorsk', NomorSkController::class)->except(['show']);
    Route::resource('prosessk', ProsesSkController::class);
    Route::resource('nomorperbup', \App\Http\Controllers\Admin\NomorPerbupController::class)->except(['show']);
    Route::resource('prosesperbup', \App\Http\Controllers\Admin\ProsesPerbupController::class);
    Route::resource('proseslain', \App\Http\Controllers\Admin\ProsesLainController::class);
});
