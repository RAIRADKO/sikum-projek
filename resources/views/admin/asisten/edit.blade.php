@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Asisten</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.asisten.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.asisten.update',$asisten->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.asisten.form', ['asisten' => $asisten])
    </form>
</div>
@endsection