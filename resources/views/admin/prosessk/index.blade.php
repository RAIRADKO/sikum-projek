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
    
    {{-- Form Pencarian --}}
    <div class="row">
        <div class="col-md-8 col-lg-6">
            <form action="{{ route('admin.prosessk.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari Kode SK, Judul, OPD, No SK..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Kode SK</th>
                    <th scope="col">Tgl Masuk</th>
                    <th scope="col">Judul SK</th>
                    <th scope="col">OPD</th>
                    <th scope="col">No. SK</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($prosesSks as $sk)
                <tr>
                    <td><strong>{{ $sk->kodesk }}</strong></td>
                    <td>{{ $sk->tglmasuksk ? \Carbon\Carbon::parse($sk->tglmasuksk)->format('d-m-Y') : '-' }}</td>
                    <td>
                        <div style="max-width: 300px;">
                            {{ \Str::limit($sk->judulsk, 60) }}
                        </div>
                    </td>
                    <td>
                        <small>{{ $sk->opd->kodeopd ?? '-' }}</small><br>
                        <strong>{{ \Str::limit($sk->opd->namaopd ?? '-', 30) }}</strong>
                    </td>
                    <td>
                        @if($sk->nosk)
                            <span class="badge bg-info">{{ $sk->nosk }}</span>
                            @if($sk->nomorSk)
                                <br><small class="text-muted">{{ $sk->nomorSk->tglsk ? \Carbon\Carbon::parse($sk->nomorSk->tglsk)->format('d-m-Y') : '' }}</small>
                            @endif
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $badgeClass = 'bg-warning text-dark';
                            if ($sk->status == 'Selesai') $badgeClass = 'bg-success';
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $sk->status }}</span>
                        
                        {{-- Status dari NomorSK jika ada --}}
                        @if($sk->nomorSk && $sk->nomorSk->status)
                            <br>
                            @php
                                $skBadgeClass = 'bg-secondary';
                                if ($sk->nomorSk->status == 'proses') $skBadgeClass = 'bg-warning text-dark';
                                if ($sk->nomorSk->status == 'bon') $skBadgeClass = 'bg-info text-dark';
                                if ($sk->nomorSk->status == 'selesai') $skBadgeClass = 'bg-success';
                            @endphp
                            <small><span class="badge {{ $skBadgeClass }}">SK: {{ ucfirst($sk->nomorSk->status) }}</span></small>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.prosessk.edit', $sk) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                <i class="fas fa-edit fa-fw"></i>
                            </a>
                            <form action="{{ route('admin.prosessk.destroy', $sk) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proses SK ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">
                        @if(request('search'))
                            Data proses SK dengan pencarian "{{ request('search') }}" tidak ditemukan.
                        @else
                            Belum ada data proses SK.
                        @endif
                    </td>
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