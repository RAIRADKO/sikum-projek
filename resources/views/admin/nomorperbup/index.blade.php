@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manajemen Nomor Perbup</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.nomorperbup.create') }}" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-plus fa-fw me-2"></i>Tambah Nomor Perbup Baru
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
        <div class="col-md-8 col-lg-6">
            <form action="{{ route('admin.nomorperbup.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari No Perbup, Judul, OPD, Status..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Nomor Perbup</th>
                    <th scope="col">Tanggal Perbup</th>
                    <th scope="col">Judul Perbup</th>
                    <th scope="col">OPD</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($nomorPerbup as $perbup)
                <tr>
                    <td>{{ $perbup->nopb }}</td>
                    <td>{{ $perbup->tglpb ? \Carbon\Carbon::parse($perbup->tglpb)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $perbup->judulpb }}</td>
                    <td>{{ $perbup->opd->namaopd ?? 'N/A' }}</td>
                    <td>
                        @php
                            $badgeClass = 'bg-secondary';
                            if ($perbup->status == 'proses') $badgeClass = 'bg-warning text-dark';
                            if ($perbup->status == 'selesai') $badgeClass = 'bg-success';
                            if ($perbup->status == 'diambil') $badgeClass = 'bg-info text-dark';
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($perbup->status) }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.nomorperbup.edit', $perbup) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-edit fa-fw"></i>
                        </a>
                        <form action="{{ route('admin.nomorperbup.destroy', $perbup) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus nomor Perbup ini?');">
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
        {{ $nomorPerbup->links() }}
    </div>
</div>
@endsection