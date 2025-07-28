@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Proses Perbup</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.prosesperbup.update', $prosesperbup) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.prosesperbup.form')
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('admin.prosesperbup.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection