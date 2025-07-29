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
    <label for="kodelain" class="form-label">Kode</label>
    <input type="text" class="form-control @error('kodelain') is-invalid @enderror" id="kodelain" name="kodelain" value="{{ old('kodelain', $proseslain->kodelain ?? '') }}" @isset($proseslain) readonly @endisset>
</div>
<div class="mb-3">
    <label for="tglmasuk" class="form-label">Tanggal Masuk</label>
    <input type="date" class="form-control @error('tglmasuk') is-invalid @enderror" id="tglmasuk" name="tglmasuk" value="{{ old('tglmasuk', $proseslain->tglmasuk ?? '') }}">
</div>
<div class="mb-3">
    <label for="judul" class="form-label">Judul</label>
    <textarea class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" rows="3">{{ old('judul', $proseslain->judul ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label for="kodeopd" class="form-label">OPD Pemrakarsa</label>
    <select class="form-select @error('kodeopd') is-invalid @enderror" id="kodeopd" name="kodeopd">
        <option value="">Pilih OPD</option>
        @foreach($opds as $opd)
            <option value="{{ $opd->kodeopd }}" @if(old('kodeopd', $proseslain->kodeopd ?? '') == $opd->kodeopd) selected @endif>{{ $opd->namaopd }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="kodeass" class="form-label">Asisten</label>
    <select class="form-select @error('kodeass') is-invalid @enderror" id="kodeass" name="kodeass">
        <option value="">Pilih Asisten</option>
        @foreach($asistens as $asisten)
            <option value="{{ $asisten->kodeass }}" @if(old('kodeass', $proseslain->kodeass ?? '') == $asisten->kodeass) selected @endif>{{ $asisten->namaass }}</option>
        @endforeach
    </select>
</div>