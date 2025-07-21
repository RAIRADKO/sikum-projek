@extends('layouts.app')

@section('title', 'Dashboard - SIKUM')

@section('content')
@auth('web')
<div class="container-fluid py-4">
    <div class="row g-4">
        <!-- Profile Card -->
        <div class="col-12">
            <div class="card border-0 shadow-sm gradient-custom">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-3 mb-md-0">
                            <div class="position-relative">
                                <div class="bg-white rounded-circle p-3 shadow-sm">
                                    <i class="fas fa-user fa-2x text-primary"></i>
                                </div>
                                <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-light rounded-circle">
                                    <span class="visually-hidden">Status Online</span>
                                </span>
                            </div>
                            <div class="ms-3">
                                <h3 class="h4 mb-1 text-white">{{ Auth::user()->nama }}</h3>
                                <p class="mb-0 text-white-50"><i class="fas fa-id-card me-2"></i>NIP: {{ Auth::user()->nip }}</p>
                                <span class="badge bg-white text-primary"><i class="fas fa-building me-2"></i>{{ Auth::user()->opd->nama_opd }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Cards -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 card-hover">
                <div class="card-body p-4">
                    <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-primary bg-primary bg-opacity-10 rounded-3 mb-3">
                        <i class="fas fa-file-alt fa-2x p-3"></i>
                    </div>
                    <h5 class="card-title">Dokumen Hukum</h5>
                    <p class="text-muted">Akses dan kelola semua dokumen hukum dalam satu tempat</p>
                    <a href="#" class="stretched-link"></a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 card-hover">
                <div class="card-body p-4">
                    <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-success bg-success bg-opacity-10 rounded-3 mb-3">
                        <i class="fas fa-search fa-2x p-3"></i>
                    </div>
                    <h5 class="card-title">Pencarian Cepat</h5>
                    <p class="text-muted">Temukan dokumen yang Anda butuhkan dengan mudah</p>
                    <a href="#" class="stretched-link"></a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 card-hover">
                <div class="card-body p-4">
                    <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-warning bg-warning bg-opacity-10 rounded-3 mb-3">
                        <i class="fas fa-history fa-2x p-3"></i>
                    </div>
                    <h5 class="card-title">Riwayat Aktivitas</h5>
                    <p class="text-muted">Pantau dan kelola aktivitas terbaru Anda</p>
                    <a href="#" class="stretched-link"></a>
                </div>
            </div>
        </div>
@endauth

        <!-- Stats Cards -->
        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="stats-icon bg-primary bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-file-text text-primary"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v text-muted"></i>
                                    </button>
                                </div>
                            </div>
                            <h3 class="fs-2 mt-3 mb-1">0</h3>
                            <p class="text-muted mb-0">Surat Keputusan</p>
                            <div class="progress mt-3" style="height: 4px;">
                                <div class="progress-bar bg-primary" style="width: 0%" role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="stats-icon bg-success bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-journal-text text-success"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v text-muted"></i>
                                    </button>
                                </div>
                            </div>
                            <h3 class="fs-2 mt-3 mb-1">0</h3>
                            <p class="text-muted mb-0">Peraturan Bupati</p>
                            <div class="progress mt-3" style="height: 4px;">
                                <div class="progress-bar bg-success" style="width: 0%" role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="stats-icon bg-info bg-opacity-10 rounded-3 p-3">
                                    <i class="fas fa-clock text-info"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v text-muted"></i>
                                    </button>
                                </div>
                            </div>
                            <h3 class="fs-2 mt-3 mb-1">0</h3>
                            <p class="text-muted mb-0">Dalam Proses</p>
                            <div class="progress mt-3" style="height: 4px;">
                                <div class="progress-bar bg-info" style="width: 0%" role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="stats-icon bg-warning bg-opacity-10 rounded-3 p-3">
                                    <i class="fas fa-check-circle text-warning"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v text-muted"></i>
                                    </button>
                                </div>
                            </div>
                            <h3 class="fs-2 mt-3 mb-1">0</h3>
                            <p class="text-muted mb-0">Selesai</p>
                            <div class="progress mt-3" style="height: 4px;">
                                <div class="progress-bar bg-warning" style="width: 0%" role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    body {
        background-color: #f8f9fa;
    }
    
    .gradient-custom {
        background: #27ae60;
    }

    .card {
        border-radius: 0.75rem;
    }

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15)!important;
    }

    .stats-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stats-icon i {
        font-size: 1.5rem;
    }

    .feature-icon-small {
        width: 64px;
        height: 64px;
    }

    .progress {
        border-radius: 0.25rem;
        overflow: hidden;
    }

    .btn-light {
        background: rgba(255, 255, 255, 0.9);
        border: none;
        backdrop-filter: blur(4px);
    }

    .btn-light:hover {
        background: #ffffff;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
    }

    .text-white-50 {
        color: rgba(255, 255, 255, 0.75) !important;
    }

    .container-fluid {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }
</style>
@endsection
