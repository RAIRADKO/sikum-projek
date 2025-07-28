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
                            <th scope="col">Status</th>
                            <th scope="col">No. SK</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prosesSkData as $sk)
                        <tr>
                            <td>{{ $sk->kodesk }}</td>
                            {{-- Menggunakan Carbon untuk memformat tanggal --}}
                            <td>{{ \Carbon\Carbon::parse($sk->tglmasuksk)->isoFormat('D MMMM YYYY') }}</td>
                            <td>{{ $sk->judulsk }}</td>
                            <td>{{ $sk->opd->namaopd ?? 'N/A' }}</td>
                            <td>
                                @php
                                    // Ambil status dari relasi, jika tidak ada, anggap 'proses'
                                    $status = optional($sk->nomorSk)->status ?? 'proses';
                                    $badgeClass = ($status == 'selesai') ? 'bg-success' : 'bg-warning text-dark';
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                            </td>
                            <td>{{ $sk->nosk ?? '-' }}</td>
                            <td>
                                @if($sk->nosk)
                                    <a href="{{ route('sk.detail', $sk->nosk) }}" class="btn btn-sm btn-info">Lihat Detail</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <div class="alert alert-warning" role="alert">
                                    Data Proses SK untuk tahun {{ $year }} tidak ditemukan.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Menampilkan link paginasi --}}
            <div class="d-flex justify-content-center">
                {{ $prosesSkData->links() }}
            </div>

        </div>
    </div>
</div>
@endsection