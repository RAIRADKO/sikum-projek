@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Manajemen User</a></li>
        <li class="breadcrumb-item active">Edit User</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-user-edit me-1"></i>
            Form Edit User
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                 <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>
                         @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                         <label for="email" class="form-label">Alamat Email</label>
                         <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                         @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nip" class="form-label">NIP (18 digit)</label>
                        <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip', $user->nip) }}" required>
                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="whatsapp" class="form-label">Nomor WhatsApp</label>
                        <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}" required>
                        @error('whatsapp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                 <div class="mb-3">
                    <label for="opd_id" class="form-label">OPD/Instansi</label>
                    <select class="form-select @error('opd_id') is-invalid @enderror" id="opd_id" name="opd_id" required>
                        <option value="">Pilih OPD</option>
                        @foreach($opds as $opd)
                            <option value="{{ $opd->id }}" {{ old('opd_id', $user->opd_id) == $opd->id ? 'selected' : '' }}>{{ $opd->nama_opd }}</option>
                        @endforeach
                    </select>
                    @error('opd_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password Baru (opsional)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                         @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-sync-alt me-1"></i>
                    Perbarui
                </button>
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                     <i class="fas fa-arrow-left me-1"></i>
                    Batal
                </a>
            </form>
        </div>
    </div>
</div>
@endsection