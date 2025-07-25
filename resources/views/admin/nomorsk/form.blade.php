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
        <label for="nosk" class="form-label">Nomor SK</label>
        {{-- Nomor SK hanya bisa diisi saat membuat baru --}}
        <input type="number" class="form-control @error('nosk') is-invalid @enderror" id="nosk" name="nosk" value="{{ old('nosk', $nomorsk->nosk ?? '') }}" @isset($nomorsk) readonly @endisset>
    </div>
    <div class="col-md-6 mb-3">
        <label for="tglsk" class="form-label">Tanggal SK</label>
        <input type="date" class="form-control @error('tglsk') is-invalid @enderror" id="tglsk" name="tglsk" value="{{ old('tglsk', $nomorsk->tglsk ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label for="judulsk" class="form-label">Judul SK</label>
    <textarea class="form-control @error('judulsk') is-invalid @enderror" id="judulsk" name="judulsk" rows="3">{{ old('judulsk', $nomorsk->judulsk ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="kodeopd" class="form-label">OPD Pemrakarsa</label>
    <select class="form-select @error('kodeopd') is-invalid @enderror" id="kodeopd" name="kodeopd">
        <option value="">Pilih OPD</option>
        @foreach($opds as $opd)
            <option value="{{ $opd->kodeopd }}" @if(old('kodeopd', $nomorsk->kodeopd ?? '') == $opd->kodeopd) selected @endif>{{ $opd->namaopd }}</option>
        @endforeach
    </select>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="tglturunsk" class="form-label">Tanggal Turun SK</label>
        <input type="date" class="form-control @error('tglturunsk') is-invalid @enderror" id="tglturunsk" name="tglturunsk" value="{{ old('tglturunsk', $nomorsk->tglturunsk ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="tglambilsk" class="form-label">Tanggal Ambil SK</label>
        <input type="date" class="form-control @error('tglambilsk') is-invalid @enderror" id="tglambilsk" name="tglambilsk" value="{{ old('tglambilsk', $nomorsk->tglambilsk ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label for="namapengambilsk" class="form-label">Nama Pengambil SK</label>
    <input type="text" class="form-control @error('namapengambilsk') is-invalid @enderror" id="namapengambilsk" name="namapengambilsk" value="{{ old('namapengambilsk', $nomorsk->namapengambilsk ?? '') }}">
</div>

<hr>

{{-- Pilihan Status Bon --}}
<div class="mb-3">
    <label for="status_bon" class="form-label">Status Bon</label>
    <select class="form-select" id="status_bon" name="status_bon">
        {{-- Logika untuk menentukan status terpilih saat validasi gagal atau saat edit --}}
        <option value="tidak_dibon" @if(old('status_bon', isset($nomorsk) && $nomorsk->namabon ? 'dibon' : 'tidak_dibon') == 'tidak_dibon') selected @endif>Tidak Dibon</option>
        <option value="dibon" @if(old('status_bon', isset($nomorsk) && $nomorsk->namabon ? 'dibon' : 'tidak_dibon') == 'dibon') selected @endif>Dibon</option>
    </select>
</div>

{{-- Field-field yang akan muncul jika status 'Dibon' --}}
<div id="bon_fields" style="display: {{ old('status_bon', isset($nomorsk) && $nomorsk->namabon ? 'dibon' : 'tidak_dibon') == 'dibon' ? 'block' : 'none' }};">
    <div class="mb-3">
        <label for="namabon" class="form-label">Nama Peminjam</label>
        <input type="text" class="form-control @error('namabon') is-invalid @enderror" id="namabon" name="namabon" value="{{ old('namabon', $nomorsk->namabon ?? '') }}">
    </div>
    <div class="mb-3">
        <label for="tglbon" class="form-label">Tanggal Pinjam</label>
        <input type="date" class="form-control @error('tglbon') is-invalid @enderror" id="tglbon" name="tglbon" value="{{ old('tglbon', $nomorsk->tglbon ?? '') }}">
    </div>
    <div class="mb-3">
        <label for="alasanbonsk" class="form-label">Alasan Pinjam</label>
        <textarea class="form-control @error('alasanbonsk') is-invalid @enderror" id="alasanbonsk" name="alasanbonsk" rows="3">{{ old('alasanbonsk', $nomorsk->alasanbonsk ?? '') }}</textarea>
    </div>
</div>

<hr>

<div class="mb-3">
    <label for="ket" class="form-label">Keterangan</label>
    <input type="text" class="form-control @error('ket') is-invalid @enderror" id="ket" name="ket" value="{{ old('ket', $nomorsk->ket ?? '') }}">
</div>

<div class="mb-3">
    <label for="kodesk" class="form-label">Kode SK</label>
    <input type="text" class="form-control @error('kodesk') is-invalid @enderror" id="kodesk" name="kodesk" value="{{ old('kodesk', $nomorsk->kodesk ?? '') }}">
</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusBonEl = document.getElementById('status_bon');
        const bonFieldsEl = document.getElementById('bon_fields');
        const namaBonInput = document.getElementById('namabon');
        const tglBonInput = document.getElementById('tglbon');
        const alasanBonInput = document.getElementById('alasanbonsk');

        statusBonEl.addEventListener('change', function () {
            if (this.value === 'dibon') {
                bonFieldsEl.style.display = 'block';
            } else {
                bonFieldsEl.style.display = 'none';
                // Kosongkan nilai field saat disembunyikan untuk menghindari data tersimpan
                namaBonInput.value = '';
                tglBonInput.value = '';
                alasanBonInput.value = '';
            }
        });
    });
</script>
@endpush