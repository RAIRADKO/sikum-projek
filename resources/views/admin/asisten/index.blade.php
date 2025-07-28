@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Asisten</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.asisten.create') }}" class="btn btn-primary">Tambah Asisten</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>KODE ASISTEN</th>
                                <th>NAMA ASISTEN</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asisten as $item)
                                <tr>
                                    <td>{{ $item->kodeass }}</td>
                                    <td>{{ $item->namaass }}</td>
                                    <td>
                                        <form action="{{ route('admin.asisten.destroy', $item->kodeass) }}" method="POST">
                                            <a class="btn btn-primary" href="{{ route('admin.asisten.edit', $item->kodeass) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection