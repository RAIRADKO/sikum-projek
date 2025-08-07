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
            <option value="{{ $opd->kodeopd }}" 
                    data-asisten="{{ $opd->kodeass }}" 
                    data-nama-asisten="{{ $opd->asisten->namaass ?? '' }}"
                    @if(old('kodeopd', $prosessk->kodeopd ?? '') == $opd->kodeopd) selected @endif>
                {{ $opd->namaopd }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="kodeass" class="form-label">Asisten</label>
    <input type="text" class="form-control" id="asisten_display" readonly style="background-color: #e9ecef;" placeholder="Akan terisi otomatis setelah memilih OPD" value="{{ isset($prosessk) && $prosessk->asisten ? $prosessk->kodeass . ' - ' . $prosessk->asisten->namaass : '' }}">
    <input type="hidden" name="kodeass" id="kodeass" value="{{ old('kodeass', $prosessk->kodeass ?? '') }}">
</div>

{{-- Field Nomor SK --}}
<div class="mb-3">
    <label for="nosk" class="form-label">Nomor SK</label>
    <select class="form-select @error('nosk') is-invalid @enderror" id="nosk" name="nosk">
        <option value="">Pilih Nomor SK (Opsional)</option>
        @foreach($nomorSks->take(50) as $nomorSk)
            <option value="{{ $nomorSk->nosk }}" @if(old('nosk', $prosessk->nosk ?? '') == $nomorSk->nosk) selected @endif>
                {{ $nomorSk->nosk }} - {{ \Str::limit($nomorSk->judulsk, 50) }}
            </option>
        @endforeach
    </select>
</div>

{{-- Fields tambahan untuk detail proses --}}
<div class="mb-3">
    <label for="jmlttdsk" class="form-label">Jumlah Tanda Tangan</label>
    <input type="number" class="form-control @error('jmlttdsk') is-invalid @enderror" id="jmlttdsk" name="jmlttdsk" value="{{ old('jmlttdsk', $prosessk->jmlttdsk ?? '') }}" min="0">
</div>
<div class="mb-3">
    <label for="tglnaikkabag" class="form-label">Tanggal Naik Kabag</label>
    <input type="date" class="form-control @error('tglnaikkabag') is-invalid @enderror" id="tglnaikkabag" name="tglnaikkabag" value="{{ old('tglnaikkabag', $prosessk->tglnaikkabag ?? '') }}">
</div>
<div class="mb-3">
    <label for="tglnaikass" class="form-label">Tanggal Naik Asisten</label>
    <input type="date" class="form-control @error('tglnaikass') is-invalid @enderror" id="tglnaikass" name="tglnaikass" value="{{ old('tglnaikass', $prosessk->tglnaikass ?? '') }}">
</div>
<div class="mb-3">
    <label for="tglturunsk" class="form-label">Tanggal Turun SK</label>
    <input type="date" class="form-control @error('tglturunsk') is-invalid @enderror" id="tglturunsk" name="tglturunsk" value="{{ old('tglturunsk', $prosessk->tglturunsk ?? '') }}">
</div>
<div class="mb-3">
    <label for="ketprosessk" class="form-label">Keterangan Proses SK</label>
    <textarea class="form-control @error('ketprosessk') is-invalid @enderror" id="ketprosessk" name="ketprosessk" rows="3">{{ old('ketprosessk', $prosessk->ketprosessk ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label for="nowa" class="form-label">No. WA</label>
    <input type="text" class="form-control @error('nowa') is-invalid @enderror" id="nowa" name="nowa" value="{{ old('nowa', $prosessk->nowa ?? '') }}" placeholder="Contoh: 08123456789">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update asisten display berdasarkan OPD yang dipilih
    const opdSelect = document.getElementById('kodeopd');
    const asistenDisplay = document.getElementById('asisten_display');
    const asistenHidden = document.getElementById('kodeass');

    function updateAsistenDisplay() {
        const selectedOption = opdSelect.options[opdSelect.selectedIndex];
        
        if (selectedOption.value && selectedOption.dataset.asisten) {
            const kodeAsisten = selectedOption.dataset.asisten;
            const namaAsisten = selectedOption.dataset.namaAsisten;
            
            asistenDisplay.value = `${kodeAsisten}${namaAsisten ? ' - ' + namaAsisten : ''}`;
            asistenHidden.value = kodeAsisten;
        } else {
            asistenDisplay.value = '';
            asistenHidden.value = '';
        }
    }

    // Set initial state
    if (opdSelect.value) {
        updateAsistenDisplay();
    }

    opdSelect.addEventListener('change', updateAsistenDisplay);
});
</script>