@extends('layouts.app')

@section('title', 'Data Proses Perbup Tahun ' . $year)

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Data Proses Perbup Tahun {{ $year }}</h1>

    {{-- Search Bar --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('perbup-proses.year', ['year' => $year]) }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Judul, Kode, atau OPD..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="card-title mb-0"><i class="bi bi-journal-text me-2"></i>Daftar Proses Peraturan Bupati</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Kode Perbup</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Judul Perbup</th>
                            <th scope="col">OPD/Dinas</th>
                            <th scope="col">Status</th>
                            <th scope="col">No. Perbup</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prosesPerbupData as $perbup)
                        <tr>
                            <td>{{ $perbup->kodepb }}</td>
                            <td>{{ $perbup->tglmasukpb ? \Carbon\Carbon::parse($perbup->tglmasukpb)->isoFormat('D MMMM YYYY') : '-' }}</td>
                            <td>{{ $perbup->judulpb }}</td>
                            <td>{{ $perbup->opd->namaopd ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $badgeClass = ($perbup->status == 'selesai') ? 'bg-success' : 'bg-warning text-dark';
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($perbup->status) }}</span>
                            </td>
                            <td>{{ $perbup->nopb ?? '-' }}</td>
                            <td>
                                <a href="{{ route('perbup-proses.detail', $perbup->kodepb) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <div class="alert alert-warning" role="alert">
                                    @if(request('search'))
                                        Data Proses Perbup dengan pencarian "{{ request('search') }}" untuk tahun {{ $year }} tidak ditemukan.
                                    @else
                                        Data Proses Perbup untuk tahun {{ $year }} tidak ditemukan.
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
                {{ $prosesPerbupData->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</div>
@endsection