@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label for="kodepb" class="form-label">Kode Perbup</label>
    <input type="text" class="form-control @error('kodepb') is-invalid @enderror" id="kodepb" name="kodepb" value="{{ old('kodepb', $prosesperbup->kodepb ?? '') }}" @isset($prosesperbup) readonly @endisset>
</div>
<div class="mb-3">
    <label for="tglmasukpb" class="form-label">Tanggal Masuk Perbup</label>
    <input type="date" class="form-control @error('tglmasukpb') is-invalid @enderror" id="tglmasukpb" name="tglmasukpb" value="{{ old('tglmasukpb', $prosesperbup->tglmasukpb ?? '') }}">
</div>
<div class="mb-3">
    <label for="judulpb" class="form-label">Judul Perbup</label>
    <textarea class="form-control @error('judulpb') is-invalid @enderror" id="judulpb" name="judulpb" rows="3">{{ old('judulpb', $prosesperbup->judulpb ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label for="kodeopd" class="form-label">OPD Pemrakarsa</label>
    <select class="form-select @error('kodeopd') is-invalid @enderror" id="kodeopd" name="kodeopd">
        <option value="">Pilih OPD</option>
        @foreach($opds as $opd)
            <option value="{{ $opd->kodeopd }}" @if(old('kodeopd', $prosesperbup->kodeopd ?? '') == $opd->kodeopd) selected @endif>{{ $opd->namaopd }}</option>
        @endforeach
    </select>
</div>

@isset($prosesperbup)
<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
        <option value="proses" {{ old('status', $prosesperbup->status) == 'proses' ? 'selected' : '' }}>Proses</option>
        <option value="selesai" {{ old('status', $prosesperbup->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
    </select>
</div>
@endisset