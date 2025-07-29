@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Data SK Lainnya</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.proseslain.update', $proseslain) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.proseslain.form')
                
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="Diproses" {{ old('status', $proseslain->status) == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Selesai" {{ old('status', $proseslain->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('admin.proseslain.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection