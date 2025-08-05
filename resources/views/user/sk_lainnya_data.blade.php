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
                            <th scope="col">Aksi</th>
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
                                <a href="{{ route('sk-lainnya.detail', $item->kodelain) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="alert alert-warning" role="alert">
                                    @if(request('search'))
                                        Data dengan pencarian "{{ request('search') }}" untuk tahun {{ $year }} tidak ditemukan.
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
            <div class="d-flex justify-content-center">
                {{ $prosesLainData->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection