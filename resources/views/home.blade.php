@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="hero-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-primary mb-4">Selamat Datang di<br>Sistem Informasi Hukum</h1>
                <p class="lead mb-4 text-muted">Portal informasi terpadu untuk pengelolaan dan akses dokumen hukum</p>

                <p class="mb-5">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#videoModal" class="text-decoration-none text-primary fw-bold">
                        <i class="fas fa-play-circle me-1"></i>
                        Lihat Cara Kerja Aplikasi
                    </a>
                </p>

                <div class="d-grid gap-3 d-sm-flex justify-content-sm-start">
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 me-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-4">
                        <i class="fas fa-user-plus me-2"></i>Register
                    </a>
                    @endguest
                </div>
            </div>
            <div class="col-lg-5 d-flex justify-content-end">
                <img src="{{ asset('img/Lambang_Kabupaten_Purworejo.png') }}" alt="Logo" class="img-fluid" style="max-width: 300px;">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="videoModalLabel">Cara Kerja Aplikasi SIKUM</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="ratio ratio-16x9">
            <iframe 
                src="https://www.youtube.com/embed/ucsa996oXVM?autoplay=1&mute=1&controls=0" 
                title="YouTube video player" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
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