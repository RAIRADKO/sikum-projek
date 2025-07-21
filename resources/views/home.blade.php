@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="hero-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-4 fw-bold text-primary mb-4">Selamat Datang di<br>Sistem Informasi Hukum</h1>
                <p class="lead mb-4 text-muted">Portal informasi terpadu untuk pengelolaan dan akses dokumen hukum</p>
                
                @guest
                <div class="d-grid gap-3 d-sm-flex justify-content-sm-start mb-5">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 me-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-4">
                        <i class="fas fa-user-plus me-2"></i>Register
                    </a>
                </div>
                @endguest
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('img/Lambang_Kabupaten_Purworejo.png') }}" alt="Logo" class="img-fluid" style="max-width: 300px;">
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .hero-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 500px;
        display: flex;
        align-items: center;
    }
    
    .card-hover:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        cursor: pointer;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    .rounded-lg {
        border-radius: 1rem !important;
    }
    
    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
    }
</style>
@endpush