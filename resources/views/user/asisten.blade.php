@extends('layouts.app')

@section('title', 'Data Asisten')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Data Asisten</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Kode Asisten</th>
                                    <th>Nama Asisten</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($asistens as $asisten)
                                <tr>
                                    <td>{{ $loop->iteration + $asistens->firstItem() - 1 }}</td>
                                    <td>{{ $asisten->kodeass }}</td>
                                    <td>{{ $asisten->namaass }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Data tidak ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {{ $asistens->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection