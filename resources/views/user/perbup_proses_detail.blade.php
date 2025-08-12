@extends('layouts.app')

@section('title', 'Detail Proses Peraturan Bupati')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-center text-white" style="background-color: #6c757d;">
            <h5 class="mb-0">INFORMASI DATA PROSES PB</h5>
        </div>
        <div class="card-body" style="background-color: #f8f9fa;">

            {{-- Data Proses PB --}}
            <div class="mb-4">
                <h6 class="fw-bold mb-3">Data Proses PB</h6>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="fw-bold" style="width: 20%;">Kode PB</td>
                            <td><input type="text" class="form-control" value="{{ $prosesPerbup->kodepb }}" readonly></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Tanggal Masuk</td>
                            <td><input type="text" class="form-control" value="{{ $prosesPerbup->tglmasukpb ? \Carbon\Carbon::parse($prosesPerbup->tglmasukpb)->format('d-m-Y') : '-' }}" readonly></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Judul</td>
                            <td><textarea class="form-control" rows="2" readonly>{{ $prosesPerbup->judulpb }}</textarea></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">OPD/ Dinas</td>
                            <td><input type="text" class="form-control" value="{{ $prosesPerbup->opd->namaopd ?? 'N/A' }}" readonly></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Jumlah Ttd</td>
                            <td><input type="text" class="form-control" value="{{ $prosesPerbup->jmlttdpb }}" readonly></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Tanggal Naik Kabag</td>
                            <td><input type="text" class="form-control" value="{{ $prosesPerbup->tglnaikkabag ? \Carbon\Carbon::parse($prosesPerbup->tglnaikkabag)->format('d-m-Y') : '-' }}" readonly></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Tanggal Naik Asisten</td>
                            <td><input type="text" class="form-control" value="{{ $prosesPerbup->tglnaikass ? \Carbon\Carbon::parse($prosesPerbup->tglnaikass)->format('d-m-Y') : '-' }}" readonly></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Asisten</td>
                            <td><input type="text" class="form-control" value="{{ $prosesPerbup->kodeass }}" readonly></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Tanggal Turun</td>
                            <td><input type="text" class="form-control" value="{{ $prosesPerbup->tglturunpb ? \Carbon\Carbon::parse($prosesPerbup->tglturunpb)->format('d-m-Y') : '-' }}" readonly></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Keterangan Proses PB</td>
                            <td><textarea class="form-control" rows="2" readonly>{{ $prosesPerbup->ketprosespb }}</textarea></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Data Penomoran PB --}}
            <div class="mb-4">
                <h6 class="fw-bold mb-3">Data Penomoran PB</h6>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="fw-bold" style="width: 20%;">Nomor PB</td>
                            <td><input type="text" class="form-control" value="{{ optional($prosesPerbup->nomorPerbup)->nopb ?? '-' }}" readonly></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Tanggal PB</td>
                            <td><input type="text" class="form-control" value="{{ optional($prosesPerbup->nomorPerbup)->tglpb ? \Carbon\Carbon::parse(optional($prosesPerbup->nomorPerbup)->tglpb)->format('d-m-Y') : '-' }}" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Data Pengambilan PB --}}
            <div class="mb-4">
                <h6 class="fw-bold mb-3">Data Pengambilan PB</h6>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="fw-bold" style="width: 20%;">Tanggal Ambil PB</td>
                            <td><input type="text" class="form-control" value="{{ optional($prosesPerbup->nomorPerbup)->tglambilpb ? \Carbon\Carbon::parse(optional($prosesPerbup->nomorPerbup)->tglambilpb)->format('d-m-Y') : '-' }}" readonly></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Nama Pengambil PB</td>
                            <td><input type="text" class="form-control" value="{{ optional($prosesPerbup->nomorPerbup)->namapengambilpb ?? '-' }}" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-start">
                <a href="{{ url()->previous() }}" class="btn btn-danger">
                    <i class="bi bi-box-arrow-left"></i> Keluar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection