@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data OPD</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.opd.update', $opd->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="namaopd">Nama OPD</label>
                            <input type="text" name="namaopd" id="namaopd" class="form-control" value="{{ $opd->namaopd }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection