@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Manajemen User</h1>
    <p class="mb-4">Daftar semua pengguna terdaftar, baik yang menunggu persetujuan maupun yang sudah disetujui.</p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm">Tambah User Baru</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>OPD</th>
                            <th>WhatsApp</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $key => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $key }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->nip }}</td>
                                <td>{{ $user->opd->nama_opd ?? 'N/A' }}</td>
                                <td>{{ $user->whatsapp }}</td>
                                <td>
                                    @if ($user->is_approved)
                                        <span class="badge badge-success">Disetujui</span>
                                    @else
                                        <span class="badge badge-warning">Menunggu Persetujuan</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->is_approved)
                                        {{-- Tombol untuk user yang sudah disetujui --}}
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-circle btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        {{-- Tombol untuk user yang menunggu persetujuan --}}
                                        
                                        {{-- PERUBAHAN DI SINI --}}
                                        <form action="{{ route('admin.user.approve', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH') {{-- Tambahkan baris ini --}}
                                            <button class="btn btn-success btn-sm">Setujui</button>
                                        </form>
                                        
                                        <form action="{{ route('admin.user.reject', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menolak dan menghapus pendaftaran ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Tolak</button>
                                        </form>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data user tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="float-right">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection