@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="{{ asset('img/Lambang_Kabupaten_Purworejo.png') }}" alt="Logo" style="width: 70px;" class="mb-3">
                        <h3 class="fw-bold mb-2">Selamat Datang di Sistem Informasi Hukum</h3>
                        <p class="text-muted mb-0">Halo, {{ Auth::user()->nama ?? Auth::user()->name }}!</p>
                    </div>
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <div class="fw-bold">NIP</div>
                                <div>{{ Auth::user()->nip ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <div class="fw-bold">OPD/Instansi</div>
                                <div>{{ Auth::user()->opd->nama_opd ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
