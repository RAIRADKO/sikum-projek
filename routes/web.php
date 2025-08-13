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
    // Dashboard Routes
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Profile & Settings Routes
    Route::post('/dashboard/update-profile', [HomeController::class, 'updateProfile'])->name('dashboard.update-profile');
    Route::get('/dashboard/notifications', [HomeController::class, 'getNotifications'])->name('dashboard.notifications');

    // Print Routes
    Route::get('/dashboard/cetak-tahunan', [HomeController::class, 'cetakTahunan'])->name('dashboard.cetak-tahunan');

    // Rute untuk menampilkan data OPD bagi user
    Route::get('/opd', [OpdController::class, 'index'])->name('opd.index');

    // Rute untuk menampilkan data Asisten bagi user
    Route::get('/asisten', [AsistenController::class, 'index'])->name('asisten.index');

    // SK Routes - Fixed route names and structure
    Route::prefix('sk')->name('sk.')->group(function () {
        Route::get('/', [SkController::class, 'index'])->name('index');
        Route::get('/{year}', [SkController::class, 'showByYear'])->name('year');
        Route::get('/detail/{nomorsk}', [SkController::class, 'show'])->name('detail');
        Route::get('/cetak/{id}', [SkController::class, 'cetak'])->name('cetak');
    });

    // SK Proses Routes - Fixed route names and structure
    Route::prefix('sk-proses')->name('sk-proses.')->group(function () {
        Route::get('/', [SkController::class, 'prosesIndex'])->name('index');
        Route::get('/{year}', [SkController::class, 'prosesShowByYear'])->name('year');
        Route::get('/detail/{kodesk}', [SkController::class, 'prosesShow'])->name('detail');
        Route::get('/nota-pengajuan/{kodesk}', [SkController::class, 'notaPengajuan'])->name('nota-pengajuan');
    });

    // Perbup Routes - Fixed route names and structure
    Route::prefix('perbup')->name('perbup.')->group(function () {
        Route::get('/', [PerbupController::class, 'index'])->name('index');
        Route::get('/{year}', [PerbupController::class, 'showByYear'])->name('year');
        Route::get('/detail/{nomorperbup}', [PerbupController::class, 'show'])->name('detail');
        Route::get('/cetak/{id}', [PerbupController::class, 'cetak'])->name('cetak');
    });

    // Perbup Proses Routes - Fixed route names and structure
    Route::prefix('perbup-proses')->name('perbup-proses.')->group(function () {
        Route::get('/', [PerbupController::class, 'prosesIndex'])->name('index');
        Route::get('/{year}', [PerbupController::class, 'prosesShowByYear'])->name('year');
        Route::get('/detail/{prosesperbup}', [PerbupController::class, 'prosesShow'])->name('detail');
    });

    // SK Lainnya Routes - Fixed route names and structure
    Route::prefix('sk-lainnya')->name('sk-lainnya.')->group(function () {
        Route::get('/', [SKLainnyaController::class, 'index'])->name('index');
        Route::get('/{year}', [SKLainnyaController::class, 'showByYear'])->name('year');
        Route::get('/detail/{proseslain}', [SKLainnyaController::class, 'show'])->name('detail');
        Route::get('/cetak/{id}', [SKLainnyaController::class, 'cetak'])->name('cetak');
    });

    // Profile redirect
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

// Additional error handling routes (optional)
Route::fallback(function () {
    return redirect()->route('home')->withErrors(['error' => 'Halaman tidak ditemukan']);
});