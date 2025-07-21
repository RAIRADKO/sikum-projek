@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-4 fw-bold text-primary mb-4">Selamat Datang di Sistem Kami</h1>
            <p class="lead mb-4">Sistem informasi terpadu untuk kebutuhan administrasi OPD</p>
            
            @guest
            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 gap-3">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4">Register</a>
            </div>
            @endguest

            @auth('web')
            <div class="card shadow mt-5">
                <div class="card-body p-5">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}&background=random" 
                                 alt="Profile" class="rounded-circle" width="80">
                        </div>
                        <div class="flex-grow-1 ms-4">
                            <h3 class="mb-1">{{ Auth::user()->nama }}</h3>
                            <p class="text-muted mb-2">NIP: {{ Auth::user()->nip }}</p>
                            <span class="badge bg-info">{{ Auth::user()->opd->nama_opd }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-4 mb-3">
                            <div class="card border-primary h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-file-alt fa-3x text-primary mb-3"></i>
                                    <h5>Formulir</h5>
                                    <p class="text-muted">Akses formulir administrasi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-success h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-chart-line fa-3x text-success mb-3"></i>
                                    <h5>Laporan</h5>
                                    <p class="text-muted">Lihat laporan kinerja</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-warning h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-bell fa-3x text-warning mb-3"></i>
                                    <h5>Notifikasi</h5>
                                    <p class="text-muted">Pemberitahuan terbaru</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .card-hover:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
</style>
@endpush