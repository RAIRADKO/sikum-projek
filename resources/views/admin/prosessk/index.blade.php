@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manajemen Proses SK</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.prosessk.create') }}" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-plus fa-fw me-2"></i>Tambah Proses SK Baru
            </a>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Kode SK</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Judul SK</th>
                    <th scope="col">OPD</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($prosesSks as $prosesSk)
                <tr>
                    <td>{{ $prosesSk->kodesk }}</td>
                    <td>{{ $prosesSk->tglmasuksk ? \Carbon\Carbon::parse($prosesSk->tglmasuksk)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $prosesSk->judulsk }}</td>
                    <td>{{ $prosesSk->opd->namaopd ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.prosessk.edit', $prosesSk) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-edit fa-fw"></i>
                        </a>
                        <form action="{{ route('admin.prosessk.destroy', $prosesSk) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proses SK ini?');">
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
                    <td colspan="5" class="text-center">Data tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $prosesSks->links() }}
    </div>
</div>
@endsection