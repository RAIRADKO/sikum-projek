@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Proses SK</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.prosessk.update', $prosessk) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.prosessk.form')
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('admin.prosessk.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection