@extends('layouts.app')

@section('title', 'Data Proses SK Tahun ' . $year)

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Data Proses SK Tahun {{ $year }}</h1>

    {{-- Search Bar --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('sk-proses.year', ['year' => $year]) }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Judul SK, Kode SK, atau OPD..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Daftar Proses Surat Keputusan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Kode SK</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Judul SK</th>
                            <th scope="col">OPD/Dinas</th>
                            <th scope="col">No. SK</th>
                            <th scope="col">Status Proses</th>
                            <th scope="col" class="text-center" style="min-width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prosesSkData as $sk)
                        <tr>
                            <td><strong>{{ $sk->kodesk }}</strong></td>
                            <td>{{ \Carbon\Carbon::parse($sk->tglmasuksk)->isoFormat('D MMMM YYYY') }}</td>
                            <td>
                                <div style="max-width: 250px;">
                                    {{ \Str::limit($sk->judulsk, 60) }}
                                    @if(strlen($sk->judulsk) > 60)
                                        <span class="text-muted" data-bs-toggle="tooltip" title="{{ $sk->judulsk }}">...</span>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $sk->opd->namaopd ?? 'N/A' }}</td>
                            <td>
                                @if($sk->nosk)
                                    <span class="badge bg-info text-white">{{ $sk->nosk }}</span>
                                    @if($sk->nomorSk && $sk->nomorSk->tglsk)
                                        <br><small class="text-muted">{{ \Carbon\Carbon::parse($sk->nomorSk->tglsk)->format('d-m-Y') }}</small>
                                    @endif
                                @else
                                    <span class="text-muted">Belum Ada</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $prosesStatus = $sk->status ?? 'Proses';
                                    $badgeClass = ($prosesStatus == 'Selesai') ? 'bg-success' : 'bg-warning text-dark';
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $prosesStatus }}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    {{-- Tombol Detail Proses SK --}}
                                    <a href="{{ route('sk-proses.detail', $sk->kodesk) }}" 
                                       class="btn btn-sm btn-outline-primary d-flex align-items-center" 
                                       data-bs-toggle="tooltip" 
                                       title="Lihat Detail">
                                        <i class="bi bi-eye me-1"></i>
                                        <span class="d-none d-md-inline">Detail</span>
                                    </a>
                                    
                                    {{-- Tombol Nota Pengajuan - hanya tampil jika status Selesai --}}
                                    @if($sk->status === 'Selesai')
                                        <a href="{{ route('sk-proses.nota-pengajuan', $sk->kodesk) }}" 
                                           class="btn btn-sm btn-outline-success d-flex align-items-center" 
                                           data-bs-toggle="tooltip" 
                                           title="Download Nota Pengajuan">
                                            <i class="bi bi-file-text me-1"></i>
                                            <span class="d-none d-md-inline">Cetak</span>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <div class="alert alert-warning mb-0" role="alert">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    @if(request('search'))
                                        Data Proses SK dengan pencarian "<strong>{{ request('search') }}</strong>" untuk tahun {{ $year }} tidak ditemukan.
                                    @else
                                        Data Proses SK untuk tahun {{ $year }} tidak ditemukan.
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Menampilkan link paginasi --}}
            @if($prosesSkData->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $prosesSkData->appends(request()->query())->links() }}
            </div>
            @endif

        </div>
    </div>
</div>

@push('styles')
<style>
/* Custom styles untuk responsive button */
@media (max-width: 768px) {
    .table-responsive .btn-sm {
        padding: 0.25rem 0.4rem;
        font-size: 0.75rem;
    }
    
    .table-responsive .btn-sm i {
        font-size: 0.8rem;
    }
}

/* Hover effect untuk tombol aksi */
.btn-outline-primary:hover,
.btn-outline-success:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: all 0.2s ease-in-out;
}

/* Styling untuk gap di mobile */
@media (max-width: 576px) {
    .gap-1 {
        gap: 0.25rem !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Initialize Bootstrap tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endpush
@endsection