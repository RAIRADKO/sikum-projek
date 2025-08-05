@extends('layouts.app')

@section('title', 'Detail Proses SK')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-center text-white" style="background-color: #6c757d;">
            <h5 class="mb-0">INFORMASI DATA PROSES SK</h5>
        </div>
        <div class="card-body" style="background-color: #f8f9fa;">
            
            {{-- Data Proses SK Section --}}
            <div class="mb-4">
                <h6 class="fw-bold mb-3">Data Proses SK</h6>
                
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Kode SK</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ $prosesSk->kodesk }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Tanggal Masuk</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($prosesSk->tglmasuksk)->format('d-m-Y') }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Judul</label>
                    </div>
                    <div class="col-md-10">
                        <textarea class="form-control" rows="3" readonly style="background-color: #e9ecef;">{{ $prosesSk->judulsk }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">OPD/Dinas</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ $prosesSk->opd->namaopd ?? 'N/A' }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Status Proses</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ $prosesSk->status ?? 'Proses' }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Jumlah Ttd</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ $prosesSk->jmlttdsk ?? '' }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Tanggal Naik Kabag</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ $prosesSk->tglnaikkabag ? \Carbon\Carbon::parse($prosesSk->tglnaikkabag)->format('d-m-Y') : '' }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Tanggal Naik Asisten</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ $prosesSk->tglnaikass ? \Carbon\Carbon::parse($prosesSk->tglnaikass)->format('d-m-Y') : '' }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Asisten</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ $prosesSk->kodeass ?? '' }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Tanggal Turun</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ $prosesSk->tglturunsk ? \Carbon\Carbon::parse($prosesSk->tglturunsk)->format('d-m-Y') : '' }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">No. WhatsApp</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ $prosesSk->nowa ?? '' }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Keterangan Proses SK</label>
                    </div>
                    <div class="col-md-10">
                        <textarea class="form-control" rows="3" readonly style="background-color: #e9ecef;">{{ $prosesSk->ketprosessk ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Data Penomoran SK Section --}}
            <div class="mb-4">
                <h6 class="fw-bold mb-3">Data Penomoran SK</h6>
                
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Nomor SK</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ $prosesSk->nosk ?? 'Belum Ada Nomor' }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                @if($prosesSk->nomorSk)
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Tanggal SK</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ $prosesSk->nomorSk->tglsk ? \Carbon\Carbon::parse($prosesSk->nomorSk->tglsk)->format('d-m-Y') : '' }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Status SK</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ ucfirst($prosesSk->nomorSk->status ?? 'proses') }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Tanggal Turun SK</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ $prosesSk->nomorSk->tglturunsk ? \Carbon\Carbon::parse($prosesSk->nomorSk->tglturunsk)->format('d-m-Y') : '' }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Tanggal Ambil SK</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ $prosesSk->nomorSk->tglambilsk ? \Carbon\Carbon::parse($prosesSk->nomorSk->tglambilsk)->format('d-m-Y') : '' }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Nama Pengambil SK</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ $prosesSk->nomorSk->namapengambilsk ?? '' }}" readonly style="background-color: #e9ecef;">
                    </div>
                </div>

                {{-- Informasi Peminjaman jika status bon --}}
                @if($prosesSk->nomorSk->status == 'bon')
                <div class="alert alert-info">
                    <h6 class="fw-bold">Informasi Peminjaman SK</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Nama Peminjam:</strong><br>
                            {{ $prosesSk->nomorSk->namabon ?? '-' }}
                        </div>
                        <div class="col-md-4">
                            <strong>Tanggal Pinjam:</strong><br>
                            {{ $prosesSk->nomorSk->tglbon ? \Carbon\Carbon::parse($prosesSk->nomorSk->tglbon)->format('d-m-Y') : '-' }}
                        </div>
                        <div class="col-md-4">
                            <strong>Alasan Pinjam:</strong><br>
                            {{ $prosesSk->nomorSk->alasanbonsk ?? '-' }}
                        </div>
                    </div>
                </div>
                @endif

                @else
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i> Nomor SK belum tersedia untuk proses ini.
                </div>
                @endif
            </div>

            {{-- Tombol Aksi --}}
            <div class="text-start">
                <a href="{{ url()->previous() }}" class="btn btn-danger">
                    <i class="bi bi-box-arrow-left"></i> Keluar
                </a>
                @if($prosesSk->nosk)
                    <a href="{{ route('sk.detail', $prosesSk->nosk) }}" class="btn btn-primary ms-2">
                        <i class="bi bi-file-text"></i> Lihat Detail SK
                    </a>
                @endif
            </div>

        </div>
    </div>
</div>

<style>
.form-label {
    margin-bottom: 0;
    padding-top: 7px;
}

.card-body {
    padding: 2rem;
}

.row.mb-3 {
    align-items: center;
}

.form-control[readonly] {
    border: 1px solid #ced4da;
}

h6.fw-bold {
    color: #495057;
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 0.5rem;
}

.alert {
    margin-top: 1rem;
}
</style>
@endsection