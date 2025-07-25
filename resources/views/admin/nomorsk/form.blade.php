@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Field SK (Nomor, Tanggal, Judul, dll) --}}
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="nosk" class="form-label">Nomor SK</label>
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
{{-- ... (field OPD, tanggal turun, tanggal ambil, nama pengambil) ... --}}
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

{{-- === BAGIAN LOGIKA STATUS === --}}

{{-- Jika mode EDIT, tampilkan pilihan Status SK --}}
@isset($nomorsk)
<div class="mb-3">
    <label for="status" class="form-label">Status SK</label>
    <select class="form-select" id="status" name="status">
        <option value="proses" @if(old('status', $nomorsk->status ?? 'proses') == 'proses') selected @endif>Proses</option>
        <option value="bon" @if(old('status', $nomorsk->status ?? '') == 'bon') selected @endif>Bon</option>
        <option value="selesai" @if(old('status', $nomorsk->status ?? '') == 'selesai') selected @endif>Selesai</option>
    </select>
</div>
@endisset

{{-- Jika mode CREATE, tampilkan pilihan Status Peminjaman --}}
@if(!isset($nomorsk))
<div class="mb-3">
    <label for="status_bon" class="form-label">Status Peminjaman</label>
    <select class="form-select" id="status_bon" name="status_bon">
        <option value="tidak_dibon" @if(old('status_bon') == 'tidak_dibon') selected @endif>Tidak Dibon</option>
        <option value="dibon" @if(old('status_bon') == 'dibon') selected @endif>Dibon</option>
    </select>
</div>
@endif

{{-- Tampilkan field ini jika status adalah 'bon' (untuk edit) atau 'dibon' (untuk create) --}}
<div id="bon_fields" style="display: none;">
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
{{-- Field Keterangan dan Kode SK --}}
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
        const bonFieldsEl = document.getElementById('bon_fields');
        const statusSkEl = document.getElementById('status');
        const statusBonEl = document.getElementById('status_bon');

        function toggleBonFields(show) {
            bonFieldsEl.style.display = show ? 'block' : 'none';
        }

        // Logika untuk mode EDIT (berdasarkan Status SK)
        if (statusSkEl) {
            // Tampilkan field saat halaman pertama kali dimuat jika status 'bon'
            toggleBonFields(statusSkEl.value === 'bon');

            statusSkEl.addEventListener('change', function () {
                toggleBonFields(this.value === 'bon');
            });
        }

        // Logika untuk mode CREATE (berdasarkan Status Peminjaman)
        if (statusBonEl) {
            // Tampilkan field saat halaman pertama kali dimuat jika ada error validasi
            toggleBonFields(statusBonEl.value === 'dibon');

            statusBonEl.addEventListener('change', function () {
                toggleBonFields(this.value === 'dibon');
            });
        }
    });
</script>
@endpush