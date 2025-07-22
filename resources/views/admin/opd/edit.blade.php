@extends('layouts.admin')

@section('title', 'Edit OPD')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit OPD</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.opd.index') }}">Manajemen OPD</a></li>
        <li class="breadcrumb-item active">Edit OPD</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Form Edit OPD
        </div>
        <div class="card-body">
            <form action="{{ route('admin.opd.update', $opd) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_opd" class="form-label">Nama OPD</label>
                    <input type="text" class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd" name="nama_opd" value="{{ old('nama_opd', $opd->nama_opd) }}" required>
                    @error('nama_opd')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-sync-alt me-1"></i>
                    Perbarui
                </button>
                <a href="{{ route('admin.opd.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>
                    Batal
                </a>
            </form>
        </div>
    </div>
</div>
@endsection