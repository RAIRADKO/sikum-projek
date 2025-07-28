@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="nopb" class="form-label">Nomor Perbup</label>
        <input type="number" class="form-control @error('nopb') is-invalid @enderror" id="nopb" name="nopb" value="{{ old('nopb', $nomorperbup->nopb ?? '') }}" @isset($nomorperbup) readonly @endisset>
    </div>
    <div class="col-md-6 mb-3">
        <label for="tglpb" class="form-label">Tanggal Perbup</label>
        <input type="date" class="form-control @error('tglpb') is-invalid @enderror" id="tglpb" name="tglpb" value="{{ old('tglpb', $nomorperbup->tglpb ?? '') }}">
    </div>
</div>
<div class="mb-3">
    <label for="judulpb" class="form-label">Judul Perbup</label>
    <textarea class="form-control @error('judulpb') is-invalid @enderror" id="judulpb" name="judulpb" rows="3">{{ old('judulpb', $nomorperbup->judulpb ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label for="kodeopd" class="form-label">OPD Pemrakarsa</label>
    <select class="form-select @error('kodeopd') is-invalid @enderror" id="kodeopd" name="kodeopd">
        <option value="">Pilih OPD</option>
        @foreach($opds as $opd)
            <option value="{{ $opd->kodeopd }}" @if(old('kodeopd', $nomorperbup->kodeopd ?? '') == $opd->kodeopd) selected @endif>{{ $opd->namaopd }}</option>
        @endforeach
    </select>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="seri" class="form-label">Seri</label>
        <select class="form-select @error('seri') is-invalid @enderror" id="seri" name="seri">
            <option value="">Pilih Seri</option>
            @foreach($series as $s)
                <option value="{{ $s->seri }}" @if(old('seri', $nomorperbup->seri ?? '') == $s->seri) selected @endif>{{ $s->kategori }} ({{ $s->seri }})</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label for="noseri" class="form-label">No. Seri</label>
        <input type="number" class="form-control @error('noseri') is-invalid @enderror" id="noseri" name="noseri" value="{{ old('noseri', $nomorperbup->noseri ?? '') }}">
    </div>
</div>
<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
        <option value="proses" @if(old('status', $nomorperbup->status ?? 'proses') == 'proses') selected @endif>Proses</option>
        <option value="selesai" @if(old('status', $nomorperbup->status ?? '') == 'selesai') selected @endif>Selesai</option>
        <option value="diambil" @if(old('status', $nomorperbup->status ?? '') == 'diambil') selected @endif>Diambil</option>
    </select>
</div>
<hr>
<div class="mb-3">
    <label for="ket" class="form-label">Keterangan</label>
    <input type="text" class="form-control @error('ket') is-invalid @enderror" id="ket" name="ket" value="{{ old('ket', $nomorperbup->ket ?? '') }}">
</div>
<div class="mb-3">
    <label for="kodepb" class="form-label">Kode Proses Perbup (opsional)</label>
    <input type="text" class="form-control @error('kodepb') is-invalid @enderror" id="kodepb" name="kodepb" value="{{ old('kodepb', $nomorperbup->kodepb ?? '') }}">
</div>