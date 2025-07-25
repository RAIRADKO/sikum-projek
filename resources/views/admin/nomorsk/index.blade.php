@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manajemen Nomor SK</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.nomorsk.create') }}" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-plus fa-fw me-2"></i>Tambah Nomor SK Baru
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
                    <th scope="col">No. SK</th>
                    <th scope="col">Tanggal SK</th>
                    <th scope="col">Judul SK</th>
                    <th scope="col">OPD</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nomorSk as $sk)
                <tr>
                    <td>{{ $sk->nosk }}</td>
                    <td>{{ $sk->tglsk }}</td>
                    <td>{{ $sk->judulsk }}</td>
                    <td>{{ $sk->opd->namaopd ?? '' }}</td>
                    <td>
                        <a href="{{ route('admin.nomorsk.edit', $sk) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-edit fa-fw"></i>
                        </a>
                        <form action="{{ route('admin.nomorsk.destroy', $sk) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus nomor SK ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash-alt fa-fw"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $nomorSk->links() }}
    </div>
</div>
@endsection