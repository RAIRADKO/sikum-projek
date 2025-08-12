@extends('layouts.app')

@section('title', 'Data Perbup Tahun ' . $year)

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Data Perbup Tahun {{ $year }}</h1>

    {{-- Search Bar --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('perbup.year', ['year' => $year]) }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Judul, OPD, atau Nomor Perbup..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="card-title mb-0"><i class="bi bi-journal-text me-2"></i>Daftar Peraturan Bupati</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Nomor Perbup</th>
                            <th scope="col">Tanggal PB</th>
                            <th scope="col">Judul PB</th>
                            <th scope="col">OPD/Dinas</th>
                            <th scope="col">Seri</th>
                            <th scope="col">Nomor Seri</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center" style="min-width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($perbupData as $perbup)
                        <tr>
                            <td>{{ $perbup->nopb }}</td>
                            <td>{{ $perbup->tglpb ? \Carbon\Carbon::parse($perbup->tglpb)->isoFormat('D MMMM YYYY') : '-' }}</td>
                            <td>{{ $perbup->judulpb }}</td>
                            <td>{{ $perbup->opd->namaopd ?? 'N/A' }}</td>
                            <td>{{ $perbup->seri }}</td>
                            <td>{{ $perbup->noseri }}</td>
                            <td>
                                @php
                                    $badgeClass = 'bg-secondary'; // Default
                                    if ($perbup->status == 'proses') {
                                        $badgeClass = 'bg-warning text-dark';
                                    } elseif ($perbup->status == 'diambil') {
                                        $badgeClass = 'bg-info text-dark';
                                    } elseif ($perbup->status == 'selesai') {
                                        $badgeClass = 'bg-success';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($perbup->status) }}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('perbup.detail', $perbup->nopb) }}" 
                                       class="btn btn-sm btn-outline-primary d-flex align-items-center" 
                                       data-bs-toggle="tooltip" 
                                       title="Lihat Detail">
                                        <i class="bi bi-eye me-1"></i>
                                        <span class="d-none d-md-inline">Detail</span>
                                    </a>
                                    
                                    {{-- Cetak Button Added Here --}}
                                    @if($perbup->status === 'selesai')
                                    <a href="{{ route('perbup.cetak', $perbup->id) }}" 
                                       class="btn btn-sm btn-outline-success d-flex align-items-center" 
                                       target="_blank"
                                       data-bs-toggle="tooltip"
                                       title="Cetak Data">
                                        <i class="bi bi-printer me-1"></i>
                                        <span class="d-none d-md-inline">Cetak</span>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                <div class="alert alert-warning mb-0" role="alert">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    @if(request('search'))
                                        Data Perbup dengan pencarian "<strong>{{ request('search') }}</strong>" untuk tahun {{ $year }} tidak ditemukan.
                                    @else
                                        Data Perbup untuk tahun {{ $year }} tidak ditemukan.
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            @if($perbupData->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $perbupData->appends(request()->query())->links() }}
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
