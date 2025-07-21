@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-4 fw-bold text-primary mb-4">Selamat Datang di Sistem Informasi Hukum</h1>
            <p class="lead mb-4">Sistem Informasi Hukum</p>
            
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
                        </div>
                        <div class="flex-grow-1 ms-4">
                            <h3 class="mb-1">{{ Auth::user()->nama }}</h3>
                            <p class="text-muted mb-2">NIP: {{ Auth::user()->nip }}</p>
                            <span class="badge bg-info">{{ Auth::user()->opd->nama_opd }}</span>
                        </div>
                    </div>
                    <hr>
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