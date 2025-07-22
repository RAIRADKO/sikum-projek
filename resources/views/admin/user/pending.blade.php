@extends('layouts.admin')

@section('title', 'Persetujuan Registrasi User')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Persetujuan Registrasi User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Persetujuan Registrasi</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user-clock me-1"></i>
            Daftar User Menunggu Persetujuan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>OPD</th>
                            <th>WhatsApp</th>
                            <th>Tanggal Daftar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingUsers as $index => $user)
                        <tr>
                            <td>{{ $pendingUsers->firstItem() + $index }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->nip }}</td>
                            <td>{{ $user->opd->nama_opd }}</td>
                            <td>{{ $user->whatsapp }}</td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.user.approve', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                </form>
                                <form action="{{ route('admin.user.reject', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menolak dan menghapus registrasi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada registrasi yang menunggu persetujuan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $pendingUsers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection