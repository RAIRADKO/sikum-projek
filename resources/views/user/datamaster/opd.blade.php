@extends('layouts.app')

@section('title', 'Data OPD')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Data Organisasi Perangkat Daerah (OPD)</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Kode OPD</th>
                                    <th>Nama OPD</th>
                                    <th>Asisten</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($opds as $opd)
                                <tr>
                                    <td>{{ $loop->iteration + $opds->firstItem() - 1 }}</td>
                                    <td>{{ $opd->kodeopd }}</td>
                                    <td>{{ $opd->namaopd }}</td>
                                    <td>{{ $opd->asisten->namaass ?? 'N/A' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Data tidak ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {{ $opds->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection