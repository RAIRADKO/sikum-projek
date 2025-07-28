@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold text-dark mb-1">
                        <i class="fas fa-plus-circle text-success me-2"></i>Tambah Asisten Baru
                    </h2>
                    <p class="text-muted mb-0">Masukkan informasi asisten baru ke dalam sistem</p>
                </div>
                <div>
                    <a class="btn btn-outline-primary btn-lg" href="{{ route('admin.asisten.index') }}" style="border-radius: 25px;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Error -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 15px; border-left: 5px solid #dc3545;">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle fa-2x text-danger me-3"></i>
                <div>
                    <h5 class="alert-heading mb-2">Terjadi Kesalahan!</h5>
                    <p class="mb-2">Mohon periksa kembali data yang Anda masukkan:</p>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form Section -->
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.asisten.store') }}" method="POST">
                @csrf
                @include('admin.asisten.form')
            </form>
        </div>
    </div>
</div>

<style>
    .container-fluid {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
    }
    
    .alert {
        border: none;
    }
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
    }
</style>
@endsection