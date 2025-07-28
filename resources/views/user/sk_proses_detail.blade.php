@extends('layouts.main_user')

@section('title', 'Detail Proses SK')

@section('content')
<div class="container">
    <h2 class="my-4">Detail Proses SK</h2>

    <div class="card">
        <div class="card-header">
            Informasi Detail
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 30%;">Nama Pengambil</th>
                        <td>{{ $prosesSk->nama }}</td>
                    </tr>
                    <tr>
                        <th>OPD</th>
                        <td>{{ $prosesSk->opd->namaopd }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk SK</th>
                        <td>{{ \Carbon\Carbon::parse($prosesSk->tglmasuksk)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($prosesSk->status == 'selesai')
                                <span class="badge bg-success text-white">Selesai</span>
                            @elseif($prosesSk->status == 'dibatalkan')
                                <span class="badge bg-danger text-white">Dibatalkan</span>
                            @else
                                <span class="badge bg-warning text-dark">Diproses</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
@endsection