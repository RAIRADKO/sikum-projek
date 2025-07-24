@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manajemen Admin</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.admin.create') }}" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-plus fa-fw me-2"></i>Tambah Admin Baru
            </a>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Whatsapp</th>
                    <th scope="col">Role</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $key => $admin)
                <tr>
                    <td>{{ $admins->firstItem() + $key }}</td>
                    <td>{{ $admin->nama }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->whatsapp }}</td>
                    <td>{{ $admin->role }}</td>
                    <td>
                        <a href="{{ route('admin.admin.edit', $admin) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-edit fa-fw"></i>
                        </a>
                        <form action="{{ route('admin.admin.destroy', $admin) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?');">
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
        {{ $admins->links() }}
    </div>
</div>
@endsection