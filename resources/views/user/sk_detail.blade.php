@extends('layouts.app')

@section('title', 'Detail SK Nomor ' . $sk->nosk)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header text-center text-white" style="background-color: #6c757d;">
            <h5 class="mb-0">INFORMASI DATA NOMOR SK</h5>
        </div>
        <div class="card-body p-0">

            {{-- Bagian Data Nomor SK --}}
            <div class="p-3" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h6 class="mb-3 fw-bold">Data Nomor SK</h6>
                
                <div class="mb-3">
                    <label class="form-label text-muted small">Nomor SK</label>
                    <div class="p-2 rounded" style="background-color: #e9ecef;">{{ $sk->nosk }}</div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted small">Tanggal SK</label>
                    <div class="p-2 rounded" style="background-color: #e9ecef;">
                        {{ $sk->tglsk ? \Carbon\Carbon::parse($sk->tglsk)->format('d-m-Y') : '' }}
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted small">Judul</label>
                    <div class="p-2 rounded" style="background-color: #e9ecef; min-height: 60px;">
                        {{ $sk->judulsk }}
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted small">OPD/Dinas</label>
                    <div class="p-2 rounded" style="background-color: #e9ecef;">
                        {{ $sk->opd->namaopd ?? 'BKD' }}
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted small">Tanggal Turun SK</label>
                    <div class="p-2 rounded" style="background-color: #e9ecef;">
                        {{ $sk->tglturunsk ? \Carbon\Carbon::parse($sk->tglturunsk)->format('d-m-Y') : '' }}
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted small">Keterangan</label>
                    <div class="p-2 rounded" style="background-color: #e9ecef; min-height: 60px;">
                        {{ $sk->ket }}
                    </div>
                </div>
            </div>

            {{-- Tampilkan bagian ini hanya jika ada data bon (peminjaman) --}}
            @if($sk->namabon)
                <div class="p-3" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                    <h6 class="mb-3 fw-bold">Data Pengebon SK</h6>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small">Nama Pengebon</label>
                        <div class="p-2 rounded" style="background-color: #e9ecef;">{{ $sk->namabon }}</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small">Tanggal Saat Ngebon</label>
                        <div class="p-2 rounded" style="background-color: #e9ecef;">
                            {{ $sk->tglbon ? \Carbon\Carbon::parse($sk->tglbon)->format('d-m-Y') : '' }}
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small">Alasan BON</label>
                        <div class="p-2 rounded" style="background-color: #e9ecef; min-height: 60px;">
                            {{ $sk->alasanbonsk }}
                        </div>
                    </div>
                </div>
            @endif

            {{-- Tampilkan bagian ini hanya jika SK sudah diambil --}}
            @if($sk->namapengambilsk)
                <div class="p-3" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                    <h6 class="mb-3 fw-bold">Data Pengambilan SK</h6>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small">Tanggal Ambil</label>
                        <div class="p-2 rounded" style="background-color: #e9ecef;">
                            {{ $sk->tglambilsk ? \Carbon\Carbon::parse($sk->tglambilsk)->format('d-m-Y') : '' }}
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small">Nama Pengambil SK</label>
                        <div class="p-2 rounded" style="background-color: #e9ecef;">{{ $sk->namapengambilsk }}</div>
                    </div>
                </div>
            @endif

        </div>
        <div class="card-footer bg-light text-start p-3">
            <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm">
                <i class="bi bi-arrow-left-circle me-1"></i>Keluar
            </a>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
    }
    
    .form-label {
        margin-bottom: 0.5rem;
        font-weight: 500;
    }
    
    .text-muted {
        color: #6c757d !important;
    }
    
    .small {
        font-size: 0.875rem;
    }
</style>
@endsection