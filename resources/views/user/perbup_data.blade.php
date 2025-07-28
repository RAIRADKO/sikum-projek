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
                            <th scope="col">Aksi</th>
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
                                <a href="{{ route('perbup.detail', $perbup->nopb) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                <div class="alert alert-warning" role="alert">
                                    @if(request('search'))
                                        Data Perbup dengan pencarian "{{ request('search') }}" untuk tahun {{ $year }} tidak ditemukan.
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
            <div class="d-flex justify-content-center">
                {{ $perbupData->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</div>
@endsection