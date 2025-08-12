@extends('layouts.app')

@section('title', 'Detail Peraturan Bupati Nomor ' . ($perbup->nopb ?? 'N/A'))

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header text-center" style="background-color: #f0f2f5; padding: 1rem;">
            <h5 class="mb-0 fw-bold">INFORMASI DATA NOMOR PB</h5>
        </div>
        <div class="card-body p-4" style="background-color: #ffffff;">

            {{-- Bagian Data Nomor PB --}}
            <div class="mb-4">
                <h6 class="fw-bold border-bottom pb-2 mb-3">Data Nomor PB</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small">Nomor PB</label>
                        <div class="p-2 rounded" style="background-color: #e9ecef;">{{ $perbup->nopb ?? '-' }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small">Tanggal PB</label>
                        <div class="p-2 rounded" style="background-color: #e9ecef;">
                            {{ $perbup->tglpb ? \Carbon\Carbon::parse($perbup->tglpb)->isoFormat('D MMMM YYYY') : '-' }}
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small">Judul</label>
                    <div class="p-2 rounded" style="background-color: #e9ecef; min-height: 80px;">
                        {{ $perbup->judulpb ?? '-' }}
                    </div>
                </div>
                 <div class="mb-3">
                    <label class="form-label text-muted small">OPD/ Dinas</label>
                    <div class="p-2 rounded" style="background-color: #e9ecef;">
                        {{ $perbup->opd->namaopd ?? 'N/A' }}
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small">Tanggal Pengundangan PB</label>
                    <div class="p-2 rounded" style="background-color: #e9ecef;">
                        {{ $perbup->tglpengundangan ? \Carbon\Carbon::parse($perbup->tglpengundangan)->isoFormat('D MMMM YYYY') : '-' }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small">Seri</label>
                        <div class="p-2 rounded" style="background-color: #e9ecef;">{{ $perbup->seri ?? '-' }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small">Nomor Seri</label>
                        <div class="p-2 rounded" style="background-color: #e9ecef;">{{ $perbup->noseri ?? '-' }}</div>
                    </div>
                </div>
                 <div class="mb-3">
                    <label class="form-label text-muted small">Tanggal Turun PB</label>
                    <div class="p-2 rounded" style="background-color: #e9ecef;">
                        {{ $perbup->tglturunpb ? \Carbon\Carbon::parse($perbup->tglturunpb)->isoFormat('D MMMM YYYY') : '-' }}
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small">Keterangan</label>
                    <div class="p-2 rounded" style="background-color: #e9ecef; min-height: 80px;">
                        {{ $perbup->ket ?? '-' }}
                    </div>
                </div>
            </div>

            {{-- Tampilkan bagian ini hanya jika ada data bon (peminjaman) --}}
            @if($perbup->namabon)
                <div class="mb-4">
                    <h6 class="fw-bold border-bottom pb-2 mb-3">Data Pengebon PB</h6>
                    <div class="mb-3">
                        <label class="form-label text-muted small">Nama Pengebon</label>
                        <div class="p-2 rounded" style="background-color: #e9ecef;">{{ $perbup->namabon }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small">Tanggal Saat Ngebon</label>
                        <div class="p-2 rounded" style="background-color: #e9ecef;">
                            {{ $perbup->tglbon ? \Carbon\Carbon::parse($perbup->tglbon)->isoFormat('D MMMM YYYY') : '' }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small">Alasan BON</label>
                        <div class="p-2 rounded" style="background-color: #e9ecef; min-height: 80px;">
                            {{ $perbup->alasanbonpb }}
                        </div>
                    </div>
                </div>
            @endif

            {{-- Tampilkan bagian ini hanya jika PB sudah diambil --}}
            @if($perbup->namapengambilpb)
                <div class="mb-4">
                    <h6 class="fw-bold border-bottom pb-2 mb-3">Data Pengambilan PB</h6>
                    <div class="mb-3">
                        <label class="form-label text-muted small">Tanggal Ambil</label>
                        <div class="p-2 rounded" style="background-color: #e9ecef;">
                            {{ $perbup->tglambilpb ? \Carbon\Carbon::parse($perbup->tglambilpb)->isoFormat('D MMMM YYYY') : '' }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small">Nama Pengambil PB</label>
                        <div class="p-2 rounded" style="background-color: #e9ecef;">{{ $perbup->namapengambilpb }}</div>
                    </div>
                </div>
            @endif

        </div>
        <div class="card-footer bg-light p-3">
            <a href="{{ url()->previous() }}" class="btn btn-danger">
                <i class="bi bi-box-arrow-left me-2"></i>Keluar
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
    }
    .form-label {
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #6c757d;
    }
</style>
@endpush