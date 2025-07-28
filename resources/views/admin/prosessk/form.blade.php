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
    <label for="kodesk" class="form-label">Kode SK</label>
    <input type="text" class="form-control @error('kodesk') is-invalid @enderror" id="kodesk" name="kodesk" value="{{ old('kodesk', $prosessk->kodesk ?? '') }}" @isset($prosessk) readonly @endisset>
</div>
<div class="mb-3">
    <label for="tglmasuksk" class="form-label">Tanggal Masuk SK</label>
    <input type="date" class="form-control @error('tglmasuksk') is-invalid @enderror" id="tglmasuksk" name="tglmasuksk" value="{{ old('tglmasuksk', $prosessk->tglmasuksk ?? '') }}">
</div>
<div class="mb-3">
    <label for="judulsk" class="form-label">Judul SK</label>
    <textarea class="form-control @error('judulsk') is-invalid @enderror" id="judulsk" name="judulsk" rows="3">{{ old('judulsk', $prosessk->judulsk ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label for="kodeopd" class="form-label">OPD Pemrakarsa</label>
    <select class="form-select @error('kodeopd') is-invalid @enderror" id="kodeopd" name="kodeopd">
        <option value="">Pilih OPD</option>
        @foreach($opds as $opd)
            <option value="{{ $opd->kodeopd }}" @if(old('kodeopd', $prosessk->kodeopd ?? '') == $opd->kodeopd) selected @endif>{{ $opd->namaopd }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="kodeass" class="form-label">Asisten</label>
    <select class="form-select @error('kodeass') is-invalid @enderror" id="kodeass" name="kodeass">
        <option value="">Pilih Asisten</option>
        @foreach($asistens as $asisten)
            <option value="{{ $asisten->kodeass }}" @if(old('kodeass', $prosessk->kodeass ?? '') == $asisten->kodeass) selected @endif>{{ $asisten->namaass }}</option>
        @endforeach
    </select>
</div>

{{-- Tambahkan field status hanya saat mode edit --}}
@isset($prosessk)
<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
        <option value="Proses" {{ old('status', $prosessk->status) == 'Proses' ? 'selected' : '' }}>Proses</option>
        <option value="Selesai" {{ old('status', $prosessk->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
    </select>
</div>
@endisset