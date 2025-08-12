@extends('layouts.app')

@section('title', 'Data SK Lainnya Tahun ' . $year)

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Data SK Lainnya Tahun {{ $year }}</h1>

    {{-- Search Bar --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('sk-lainnya.year', ['year' => $year]) }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Judul, Kode, atau OPD..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="card-title mb-0"><i class="bi bi-file-text me-2"></i>Daftar SK Lainnya</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Kode</th>
                            <th scope="col">Tanggal Masuk</th>
                            <th scope="col">Judul</th>
                            <th scope="col">OPD/Dinas</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center" style="min-width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prosesLainData as $item)
                        <tr>
                            <td>{{ $item->kodelain }}</td>
                            <td>{{ $item->tglmasuk ? \Carbon\Carbon::parse($item->tglmasuk)->isoFormat('D MMMM YYYY') : '-' }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->opd->namaopd ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $badgeClass = ($item->status == 'Selesai') ? 'bg-success' : 'bg-warning text-dark';
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($item->status) }}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('sk-lainnya.detail', $item->kodelain) }}" 
                                       class="btn btn-sm btn-outline-primary d-flex align-items-center" 
                                       data-bs-toggle="tooltip" 
                                       title="Lihat Detail">
                                        <i class="bi bi-eye me-1"></i>
                                        <span class="d-none d-md-inline">Detail</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="alert alert-warning mb-0" role="alert">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    @if(request('search'))
                                        Data dengan pencarian "<strong>{{ request('search') }}</strong>" untuk tahun {{ $year }} tidak ditemukan.
                                    @else
                                        Data untuk tahun {{ $year }} tidak ditemukan.
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            @if($prosesLainData->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $prosesLainData->appends(request()->query())->links() }}
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