@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manajemen SK Lainnya</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.proseslain.create') }}" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-plus fa-fw me-2"></i>Tambah Data SK Lainnya
            </a>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('admin.proseslain.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Kode, Judul, atau OPD..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Kode</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Judul</th>
                    <th scope="col">OPD</th>
                    <th scope="col">Asisten</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($prosesLain as $item)
                <tr>
                    <td>{{ $item->kodelain }}</td>
                    <td>{{ $item->tglmasuk ? \Carbon\Carbon::parse($item->tglmasuk)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->opd->namaopd ?? 'N/A' }}</td>
                    <td>{{ $item->asisten->namaass ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.proseslain.edit', $item) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-edit fa-fw"></i>
                        </a>
                        <form action="{{ route('admin.proseslain.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash-alt fa-fw"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $prosesLain->links() }}
    </div>
</div>
@endsection