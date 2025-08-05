{{-- resources/views/admin/prosessk/form.blade.php --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Data Dasar Proses SK --}}
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="kodesk" class="form-label">Kode SK <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('kodesk') is-invalid @enderror" id="kodesk" name="kodesk" value="{{ old('kodesk', $prosessk->kodesk ?? '') }}" @isset($prosessk) readonly @endisset>
    </div>
    <div class="col-md-6 mb-3">
        <label for="tglmasuksk" class="form-label">Tanggal Masuk SK <span class="text-danger">*</span></label>
        <input type="date" class="form-control @error('tglmasuksk') is-invalid @enderror" id="tglmasuksk" name="tglmasuksk" value="{{ old('tglmasuksk', $prosessk->tglmasuksk ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label for="judulsk" class="form-label">Judul SK <span class="text-danger">*</span></label>
    <textarea class="form-control @error('judulsk') is-invalid @enderror" id="judulsk" name="judulsk" rows="3" placeholder="Masukkan judul/perihal SK">{{ old('judulsk', $prosessk->judulsk ?? '') }}</textarea>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="kodeopd" class="form-label">OPD Pemrakarsa <span class="text-danger">*</span></label>
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
    <div class="col-md-6 mb-3">
        <label for="asisten_display" class="form-label">Asisten</label>
        <input type="text" class="form-control" id="asisten_display" readonly 
               style="background-color: #e9ecef;" 
               placeholder="Pilih OPD terlebih dahulu">
        {{-- Hidden field untuk menyimpan kode asisten --}}
        <input type="hidden" name="kodeass" id="kodeass" value="{{ old('kodeass', $prosessk->kodeass ?? '') }}">
    </div>
</div>

{{-- Nomor SK --}}
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
    <div class="form-text">Pilih nomor SK jika sudah tersedia</div>
</div>

<hr>

{{-- Detail Proses --}}
<h6 class="fw-bold text-primary mb-3">Detail Proses SK</h6>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="jmlttdsk" class="form-label">Jumlah Tanda Tangan</label>
        <input type="number" class="form-control @error('jmlttdsk') is-invalid @enderror" id="jmlttdsk" name="jmlttdsk" value="{{ old('jmlttdsk', $prosessk->jmlttdsk ?? '') }}" min="0">
    </div>
    <div class="col-md-4 mb-3">
        <label for="tglnaikkabag" class="form-label">Tanggal Naik Kabag</label>
        <input type="date" class="form-control @error('tglnaikkabag') is-invalid @enderror" id="tglnaikkabag" name="tglnaikkabag" value="{{ old('tglnaikkabag', $prosessk->tglnaikkabag ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label for="tglnaikass" class="form-label">Tanggal Naik Asisten</label>
        <input type="date" class="form-control @error('tglnaikass') is-invalid @enderror" id="tglnaikass" name="tglnaikass" value="{{ old('tglnaikass', $prosessk->tglnaikass ?? '') }}">
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="tglturunsk" class="form-label">Tanggal Turun SK</label>
        <input type="date" class="form-control @error('tglturunsk') is-invalid @enderror" id="tglturunsk" name="tglturunsk" value="{{ old('tglturunsk', $prosessk->tglturunsk ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="nowa" class="form-label">No. WA</label>
        <input type="text" class="form-control @error('nowa') is-invalid @enderror" id="nowa" name="nowa" value="{{ old('nowa', $prosessk->nowa ?? '') }}" placeholder="Contoh: 08123456789">
    </div>
</div>

<div class="mb-3">
    <label for="ketprosessk" class="form-label">Keterangan Proses SK</label>
    <textarea class="form-control @error('ketprosessk') is-invalid @enderror" id="ketprosessk" name="ketprosessk" rows="3" placeholder="Masukkan keterangan proses SK (opsional)">{{ old('ketprosessk', $prosessk->ketprosessk ?? '') }}</textarea>
</div>

{{-- Status (hanya untuk edit) --}}
@isset($prosessk)
<div class="mb-3">
    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
        <option value="Proses" @if(old('status', $prosessk->status ?? 'Proses') == 'Proses') selected @endif>Proses</option>
        <option value="Selesai" @if(old('status', $prosessk->status ?? '') == 'Selesai') selected @endif>Selesai</option>
    </select>
</div>
@endisset

{{-- Bagian Nota Pengajuan (hanya tampil jika status Selesai) --}}
@isset($prosessk)
<div id="nota_pengajuan_section" style="display: none;">
    <hr>
    <h6 class="fw-bold text-success mb-3">Data Nota Pengajuan SK</h6>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="ditujukan_kepada" class="form-label">Ditujukan Kepada</label>
            <input type="text" class="form-control" id="ditujukan_kepada" name="ditujukan_kepada" value="{{ old('ditujukan_kepada', $prosessk->notaPengajuan->ditujukan_kepada ?? '') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="melalui" class="form-label">Melalui</label>
            <input type="text" class="form-control" id="melalui" name="melalui" value="{{ old('melalui', $prosessk->notaPengajuan->melalui ?? '') }}">
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="dari" class="form-label">Dari</label>
            <input type="text" class="form-control" id="dari" name="dari" value="{{ old('dari', $prosessk->notaPengajuan->dari ?? '') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="perihal" class="form-label">Perihal</label>
            <input type="text" class="form-control" id="perihal" name="perihal" value="{{ old('perihal', $prosessk->notaPengajuan->perihal ?? '') }}">
        </div>
    </div>
    
    <div class="mb-3">
        <label for="mohon_untuk" class="form-label">Mohon Untuk</label>
        <textarea class="form-control" id="mohon_untuk" name="mohon_untuk" rows="3">{{ old('mohon_untuk', $prosessk->notaPengajuan->mohon_untuk ?? '') }}</textarea>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="tempat_tanggal" class="form-label">Tempat, Tanggal</label>
            <input type="text" class="form-control" id="tempat_tanggal" name="tempat_tanggal" value="{{ old('tempat_tanggal', $prosessk->notaPengajuan->tempat_tanggal ?? '') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="nama_penandatangan" class="form-label">Nama Penandatangan</label>
            <input type="text" class="form-control" id="nama_penandatangan" name="nama_penandatangan" value="{{ old('nama_penandatangan', $prosessk->notaPengajuan->nama_penandatangan ?? '') }}">
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="jabatan_penandatangan" class="form-label">Jabatan Penandatangan</label>
            <input type="text" class="form-control" id="jabatan_penandatangan" name="jabatan_penandatangan" value="{{ old('jabatan_penandatangan', $prosessk->notaPengajuan->jabatan_penandatangan ?? '') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="nip_penandatangan" class="form-label">NIP Penandatangan</label>
            <input type="text" class="form-control" id="nip_penandatangan" name="nip_penandatangan" value="{{ old('nip_penandatangan', $prosessk->notaPengajuan->nip_penandatangan ?? '') }}">
        </div>
    </div>
</div>
@endisset

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const opdSelect = document.getElementById('kodeopd');
    const asistenDisplay = document.getElementById('asisten_display');
    const asistenHidden = document.getElementById('kodeass');
    const statusEl = document.getElementById('status');
    const notaSection = document.getElementById('nota_pengajuan_section');
    
    // Function untuk update display asisten
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
    
    // Set initial state berdasarkan data yang sudah ada
    if (opdSelect.value) {
        updateAsistenDisplay();
    }
    
    // Event listener untuk perubahan OPD
    opdSelect.addEventListener('change', updateAsistenDisplay);
    
    // Handle nota pengajuan section
    if (statusEl && notaSection) {
        function toggleNotaSection() {
            if (statusEl.value === 'Selesai') {
                notaSection.style.display = 'block';
            } else {
                notaSection.style.display = 'none';
            }
        }
        
        // Jalankan saat halaman dimuat
        toggleNotaSection();
        
        // Jalankan saat status berubah
        statusEl.addEventListener('change', toggleNotaSection);
    }
});
</script>
@endpush