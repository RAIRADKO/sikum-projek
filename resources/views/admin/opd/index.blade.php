@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data OPD</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.opd.create') }}" class="btn btn-success btn-sm">Tambah Data</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode OPD</th>
                                    <th>Nama OPD</th>
                                    <th>Kode Asisten</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($opds as $opd)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $opd->kodeopd }}</td>
                                    <td>{{ $opd->namaopd }}</td>
                                    <td>{{ $opd->asisten->namaass ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('admin.opd.edit', $opd->kodeopd) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('admin.opd.destroy', $opd->kodeopd) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data Kosong</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {{ $opds->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection