@extends('layouts.admin')

@section('title', 'Tambah OPD')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah OPD Baru</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.opd.index') }}">Manajemen OPD</a></li>
        <li class="breadcrumb-item active">Tambah OPD</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-plus-circle me-1"></i>
            Form Tambah OPD
        </div>
        <div class="card-body">
            <form action="{{ route('admin.opd.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="namaopd" class="form-label">Nama OPD</label>
                    <input type="text" class="form-control @error('namaopd') is-invalid @enderror" id="namaopd" name="namaopd" value="{{ old('namaopd') }}" required autofocus>
                    @error('namaopd')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kodeass" class="form-label">Kode Asisten</label>
                    <select class="form-select @error('kodeass') is-invalid @enderror" id="kodeass" name="kodeass" required>
                        <option value="" disabled selected>Pilih Kode Asisten</option>
                        @foreach($asistens as $asisten)
                            <option value="{{ $asisten->kodeass }}" {{ old('kodeass') == $asisten->kodeass ? 'selected' : '' }}>{{ $asisten->namaass }}</option>
                        @endforeach
                    </select>
                    @error('kodeass')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>
                    Simpan
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