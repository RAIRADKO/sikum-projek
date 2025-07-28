@extends('layouts.app')

@section('title', 'Detail SK Nomor ' . $sk->nosk)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Informasi Data Nomor SK</h4>
        </div>
        <div class="card-body p-4">

            {{-- Bagian Data Nomor SK --}}
            <h5 class="mb-3">Data Nomor SK</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nomor SK</label>
                    <input type="text" class="form-control" value="{{ $sk->nosk }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal SK</label>
                    <input type="text" class="form-control" value="{{ $sk->tglsk ? \Carbon\Carbon::parse($sk->tglsk)->isoFormat('D MMMM YYYY') : '' }}" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Judul</label>
                <textarea class="form-control" rows="3" readonly>{{ $sk->judulsk }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">OPD/Dinas</label>
                    <input type="text" class="form-control" value="{{ $sk->opd->namaopd ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal Turun SK</label>
                    {{-- Menggunakan Carbon::parse untuk mengubah string menjadi objek tanggal terlebih dahulu --}}
                    <input type="text" class="form-control" value="{{ $sk->tglturunsk ? \Carbon\Carbon::parse($sk->tglturunsk)->isoFormat('D MMMM YYYY') : 'Belum turun' }}" readonly>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Keterangan</label>
                <textarea class="form-control" rows="2" readonly>{{ $sk->ket }}</textarea>
            </div>

            {{-- Tampilkan bagian ini hanya jika ada data bon (peminjaman) --}}
            @if($sk->namabon)
                <hr class="my-4">
                <h5 class="mb-3 text-info">Data Pengebon SK</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Pengebon</label>
                        <input type="text" class="form-control" value="{{ $sk->namabon }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Saat Ngebon</label>
                        <input type="text" class="form-control" value="{{ $sk->tglbon ? \Carbon\Carbon::parse($sk->tglbon)->isoFormat('D MMMM YYYY') : '' }}" readonly>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Alasan BON</label>
                    <textarea class="form-control" rows="3" readonly>{{ $sk->alasanbonsk }}</textarea>
                </div>
            @endif

            {{-- Tampilkan bagian ini hanya jika SK sudah diambil --}}
            @if($sk->namapengambilsk)
                 <hr class="my-4">
                 <h5 class="mb-3 text-success">Data Pengambilan SK</h5>
                 <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Ambil</label>
                        <input type="text" class="form-control" value="{{ $sk->tglambilsk ? \Carbon\Carbon::parse($sk->tglambilsk)->isoFormat('D MMMM YYYY') : '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Pengambil SK</label>
                        <input type="text" class="form-control" value="{{ $sk->namapengambilsk }}" readonly>
                    </div>
                 </div>
            @endif

        </div>
        <div class="card-footer bg-light text-end">
            <a href="{{ url()->previous() }}" class="btn btn-danger">
                <i class="bi bi-arrow-left-circle me-2"></i>Keluar
            </a>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .form-control[readonly] {
        background-color: #e9ecef;
        opacity: 1;
    }
</style>
@endsection