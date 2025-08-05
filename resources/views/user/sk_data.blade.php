@extends('layouts.app')

@section('title', 'Data SK Tahun ' . $year)

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Data SK Tahun {{ $year }}</h1>

    {{-- Search Bar --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('sk.year', ['year' => $year]) }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Judul SK atau OPD..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Daftar Surat Keputusan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nomor SK</th>
                            <th scope="col">Tanggal SK</th>
                            <th scope="col">Judul SK</th>
                            <th scope="col">OPD/Dinas</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($skData as $sk)
                        <tr>
                            <td>{{ $sk->nosk }}</td>
                            {{-- Menggunakan Carbon untuk memformat tanggal --}}
                            <td>{{ \Carbon\Carbon::parse($sk->tglsk)->isoFormat('D MMMM YYYY') }}</td>
                            <td>{{ $sk->judulsk }}</td>
                            <td>{{ $sk->opd->namaopd ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $badgeClass = 'bg-secondary'; // Default
                                    if ($sk->status == 'proses') {
                                        $badgeClass = 'bg-warning text-dark';
                                    } elseif ($sk->status == 'bon') {
                                        $badgeClass = 'bg-info text-dark';
                                    } elseif ($sk->status == 'selesai') {
                                        $badgeClass = 'bg-success';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($sk->status) }}</span>
                            </td>
                            <td>
                                {{-- Ubah baris ini --}}
                                <a href="{{ route('sk.detail', $sk->nosk) }}" class="btn btn-sm btn-info">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="alert alert-warning" role="alert">
                                    Data SK untuk tahun {{ $year }} tidak ditemukan.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Menampilkan link paginasi --}}
            <div class="d-flex justify-content-center">
                {{ $skData->links() }}
            </div>

        </div>
    </div>
</div>
@endsection