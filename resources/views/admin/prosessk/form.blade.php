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

{{-- Form Nota Pengajuan yang muncul saat status = Selesai --}}
<div id="nota-pengajuan-form" style="display: {{ old('status', $prosessk->status) == 'Selesai' ? 'block' : 'none' }};">
    <div class="card mt-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">NOTA PENGAJUAN</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="ditujukan_kepada" class="form-label">Ditujukan Kepada</label>
                        <input type="text" class="form-control @error('ditujukan_kepada') is-invalid @enderror" 
                               id="ditujukan_kepada" name="ditujukan_kepada" 
                               value="{{ old('ditujukan_kepada', $prosessk->notaPengajuan->ditujukan_kepada ?? 'Bupati Purworejo') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="melalui" class="form-label">Melalui</label>
                        <input type="text" class="form-control @error('melalui') is-invalid @enderror" 
                               id="melalui" name="melalui" 
                               value="{{ old('melalui', $prosessk->notaPengajuan->melalui ?? '') }}"
                               placeholder="Contoh: Wakil Bupati Purworejo">
                    </div>
                </div>
            </div>

            {{-- Bagian Lewat dengan tombol tambah --}}
            <div class="mb-3">
                <label for="lewat" class="form-label">Lewat</label>
                <div id="lewat-container">
                    @php
                        $lewatData = old('lewat', $prosessk->notaPengajuan->lewat ?? '');
                        $lewatLines = !empty($lewatData) ? explode("\n", $lewatData) : [''];
                    @endphp
                    @if(!empty($lewatLines[0]))
                        @foreach($lewatLines as $line)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" value="{{ trim($line) }}">
                                <button type="button" class="btn btn-danger remove-line">-</button>
                            </div>
                        @endforeach
                    @else
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="Contoh: Sekretaris Daerah Kab. Purworejo">
                            <button type="button" class="btn btn-danger remove-line">-</button>
                        </div>
                    @endif
                </div>
                <button type="button" class="btn btn-success mt-2" id="add-lewat">+ Tambah Baris</button>
                <textarea class="form-control @error('lewat') is-invalid @enderror" 
                          id="lewat" name="lewat" rows="4" style="display: none">{{ old('lewat', $prosessk->notaPengajuan->lewat ?? '') }}</textarea>
                @error('lewat')
                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="dari" class="form-label">Dari</label>
                <input type="text" class="form-control @error('dari') is-invalid @enderror" 
                       id="dari" name="dari" 
                       value="{{ old('dari', $prosessk->notaPengajuan->dari ?? '') }}"
                       placeholder="Contoh: Bagian Hukum Setda Kab.Purworejo">
            </div>

            <div class="mb-3">
                <label for="perihal" class="form-label">Perihal</label>
                <textarea class="form-control @error('perihal') is-invalid @enderror" 
                          id="perihal" name="perihal" rows="3" 
                          placeholder="Jelaskan perihal/subject surat">{{ old('perihal', $prosessk->notaPengajuan->perihal ?? '') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="mohon_untuk" class="form-label">Mohon untuk</label>
                        <input type="text" class="form-control @error('mohon_untuk') is-invalid @enderror" 
                               id="mohon_untuk" name="mohon_untuk" 
                               value="{{ old('mohon_untuk', $prosessk->notaPengajuan->mohon_untuk ?? '') }}"
                               placeholder="Contoh: Tapak Asman">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanda_tangan" class="form-label">Tanda Tangan</label>
                        <input type="text" class="form-control @error('tanda_tangan') is-invalid @enderror" 
                               id="tanda_tangan" name="tanda_tangan" 
                               value="{{ old('tanda_tangan', $prosessk->notaPengajuan->tanda_tangan ?? '') }}"
                               placeholder="Contoh: 3 (tiga) kali">
                    </div>
                </div>
            </div>

            {{-- Bagian Lain-lain dengan tombol tambah --}}
            <div class="mb-3">
                <label for="lain_lain" class="form-label">Lain-lain</label>
                <div id="lain-lain-container">
                    @php
                        $lainData = old('lain_lain', $prosessk->notaPengajuan->lain_lain ?? '');
                        $lainLines = !empty($lainData) ? explode("\n", $lainData) : [''];
                    @endphp
                    @if(!empty($lainLines[0]))
                        @foreach($lainLines as $line)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" value="{{ trim($line) }}">
                                <button type="button" class="btn btn-danger remove-line">-</button>
                            </div>
                        @endforeach
                    @else
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="Contoh: Materi dari BPKPAD Kab. Purworejo">
                            <button type="button" class="btn btn-danger remove-line">-</button>
                        </div>
                    @endif
                </div>
                <button type="button" class="btn btn-success mt-2" id="add-lain-lain">+ Tambah Baris</button>
                <textarea class="form-control @error('lain_lain') is-invalid @enderror" 
                          id="lain_lain" name="lain_lain" rows="4" style="display: none">{{ old('lain_lain', $prosessk->notaPengajuan->lain_lain ?? '') }}</textarea>
                @error('lain_lain')
                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tempat_tanggal" class="form-label">Tempat, Tanggal</label>
                        <input type="text" class="form-control @error('tempat_tanggal') is-invalid @enderror" 
                               id="tempat_tanggal" name="tempat_tanggal" 
                               value="{{ old('tempat_tanggal', $prosessk->notaPengajuan->tempat_tanggal ?? '') }}"
                               placeholder="Contoh: Purworejo, 5 Agustus 2025">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="jabatan_penandatangan" class="form-label">Jabatan Penandatangan</label>
                        <input type="text" class="form-control @error('jabatan_penandatangan') is-invalid @enderror" 
                               id="jabatan_penandatangan" name="jabatan_penandatangan" 
                               value="{{ old('jabatan_penandatangan', $prosessk->notaPengajuan->jabatan_penandatangan ?? '') }}"
                               placeholder="Contoh: KEPALA BAGIAN HUKUM">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="instansi_penandatangan" class="form-label">Instansi Penandatangan</label>
                        <input type="text" class="form-control @error('instansi_penandatangan') is-invalid @enderror" 
                               id="instansi_penandatangan" name="instansi_penandatangan" 
                               value="{{ old('instansi_penandatangan', $prosessk->notaPengajuan->instansi_penandatangan ?? '') }}"
                               placeholder="Contoh: SETDA KABUPATEN PURWOREJO">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="nama_penandatangan" class="form-label">Nama Penandatangan</label>
                        <input type="text" class="form-control @error('nama_penandatangan') is-invalid @enderror" 
                               id="nama_penandatangan" name="nama_penandatangan" 
                               value="{{ old('nama_penandatangan', $prosessk->notaPengajuan->nama_penandatangan ?? '') }}"
                               placeholder="Contoh: PUGUH TRIHATMOKO, SH, MH">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="pangkat_penandatangan" class="form-label">Pangkat Penandatangan</label>
                        <input type="text" class="form-control @error('pangkat_penandatangan') is-invalid @enderror" 
                               id="pangkat_penandatangan" name="pangkat_penandatangan" 
                               value="{{ old('pangkat_penandatangan', $prosessk->notaPengajuan->pangkat_penandatangan ?? '') }}"
                               placeholder="Contoh: Pembina Tk I">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nip_penandatangan" class="form-label">NIP Penandatangan</label>
                        <input type="text" class="form-control @error('nip_penandatangan') is-invalid @enderror" 
                               id="nip_penandatangan" name="nip_penandatangan" 
                               value="{{ old('nip_penandatangan', $prosessk->notaPengajuan->nip_penandatangan ?? '') }}"
                               placeholder="Contoh: 19750829 199903 1 005">
                    </div>
                </div>
            </div>
        </div>
    </div>
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

    // Handle status change untuk nota pengajuan
    const statusSelect = document.getElementById('status');
    const notaPengajuanForm = document.getElementById('nota-pengajuan-form');
    
    if (statusSelect && notaPengajuanForm) {
        statusSelect.addEventListener('change', function() {
            if (this.value === 'Selesai') {
                notaPengajuanForm.style.display = 'block';
            } else {
                notaPengajuanForm.style.display = 'none';
            }
        });
    }

    // Fungsi untuk mengupdate textarea tersembunyi
    function updateHiddenTextarea(containerId, textareaId) {
        const container = document.getElementById(containerId);
        const inputs = container.querySelectorAll('input');
        const values = Array.from(inputs).map(input => input.value);
        document.getElementById(textareaId).value = values.join('\n');
    }

    // Fungsi untuk menambahkan baris
    function addLine(containerId, placeholder) {
        const container = document.getElementById(containerId);
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" class="form-control" placeholder="${placeholder}">
            <button type="button" class="btn btn-danger remove-line">-</button>
        `;
        container.appendChild(div);
        
        // Tambahkan event listener untuk tombol hapus
        div.querySelector('.remove-line').addEventListener('click', function() {
            div.remove();
            if (containerId === 'lewat-container') {
                updateHiddenTextarea('lewat-container', 'lewat');
            } else {
                updateHiddenTextarea('lain-lain-container', 'lain_lain');
            }
        });
        
        // Tambahkan event listener untuk input
        div.querySelector('input').addEventListener('input', function() {
            if (containerId === 'lewat-container') {
                updateHiddenTextarea('lewat-container', 'lewat');
            } else {
                updateHiddenTextarea('lain-lain-container', 'lain_lain');
            }
        });
    }

    // Event listeners untuk tombol tambah
    const addLewatBtn = document.getElementById('add-lewat');
    const addLainBtn = document.getElementById('add-lain-lain');
    
    if (addLewatBtn) {
        addLewatBtn.addEventListener('click', function() {
            addLine('lewat-container', 'Baris tambahan...');
            updateHiddenTextarea('lewat-container', 'lewat');
        });
    }

    if (addLainBtn) {
        addLainBtn.addEventListener('click', function() {
            addLine('lain-lain-container', 'Baris tambahan...');
            updateHiddenTextarea('lain-lain-container', 'lain_lain');
        });
    }

    // Inisialisasi event listener untuk baris yang sudah ada
    document.querySelectorAll('.remove-line').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.input-group').remove();
            if (this.closest('#lewat-container')) {
                updateHiddenTextarea('lewat-container', 'lewat');
            } else {
                updateHiddenTextarea('lain-lain-container', 'lain_lain');
            }
        });
    });

    // Inisialisasi event listener untuk input yang sudah ada
    document.querySelectorAll('#lewat-container input, #lain-lain-container input').forEach(input => {
        input.addEventListener('input', function() {
            if (this.closest('#lewat-container')) {
                updateHiddenTextarea('lewat-container', 'lewat');
            } else {
                updateHiddenTextarea('lain-lain-container', 'lain_lain');
            }
        });
    });

    // Update hidden textarea saat pertama kali load
    if (document.getElementById('lewat-container')) {
        updateHiddenTextarea('lewat-container', 'lewat');
    }
    if (document.getElementById('lain-lain-container')) {
        updateHiddenTextarea('lain-lain-container', 'lain_lain');
    }
});
</script>