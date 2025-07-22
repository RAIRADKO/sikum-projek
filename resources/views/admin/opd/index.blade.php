@extends('layouts.admin')

@section('title', 'Manajemen OPD')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manajemen OPD</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Manajemen OPD</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-building me-1"></i>
                Daftar OPD
            </div>
            <a href="{{ route('admin.opd.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i>
                Tambah OPD
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama OPD</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($opds as $index => $opd)
                        <tr>
                            <td>{{ $opds->firstItem() + $index }}</td>
                            <td>{{ $opd->nama_opd }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.opd.edit', $opd) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.opd.destroy', $opd) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus OPD ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data OPD.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $opds->links() }}
            </div>
        </div>
    </div>
</div>
@endsection