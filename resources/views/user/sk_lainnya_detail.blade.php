@extends('layouts.app')

@section('title', 'Detail SK Lainnya')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header text-center text-white" style="background-color: #6c757d;">
            <h5 class="mb-0">INFORMASI DETAIL SK LAINNYA</h5>
        </div>
        <div class="card-body p-4" style="background-color: #f8f9fa;">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label text-muted">Kode</label>
                <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $prosesLain->kodelain }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label text-muted">Tanggal Masuk</label>
                <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $prosesLain->tglmasuk ? \Carbon\Carbon::parse($prosesLain->tglmasuk)->isoFormat('D MMMM YYYY') : '-' }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label text-muted">Judul</label>
                <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $prosesLain->judul }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label text-muted">OPD/Dinas</label>
                <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $prosesLain->opd->namaopd ?? 'N/A' }}</p>
                </div>
            </div>
             <div class="row mb-3">
                <label class="col-sm-3 col-form-label text-muted">Asisten</label>
                <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $prosesLain->asisten->namaass ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label text-muted">Status</label>
                <div class="col-sm-9">
                     @php
                        $badgeClass = ($prosesLain->status == 'Selesai') ? 'bg-success' : 'bg-warning text-dark';
                    @endphp
                    <span class="badge {{ $badgeClass }} fs-6">{{ ucfirst($prosesLain->status) }}</span>
                </div>
            </div>
             <div class="row mb-3">
                <label class="col-sm-3 col-form-label text-muted">Keterangan</label>
                <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $prosesLain->ket ?? '-' }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light text-start p-3">
            <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm">
                <i class="bi bi-arrow-left-circle me-1"></i>Kembali
            </a>
        </div>
    </div>
</div>
@endsection