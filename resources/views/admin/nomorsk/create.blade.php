@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Nomor SK Baru</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.nomorsk.store') }}" method="POST">
                @csrf
                @include('admin.nomorsk.form')
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.nomorsk.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection