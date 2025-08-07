@extends('layouts.app')

@section('title', 'Nota Pengajuan SK')

@push('styles')
<style>
    /* GENERAL STYLES */
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .nota-container {
        max-width: 900px;
        margin: 30px auto;
    }
    
    /* CARD & HEADER */
    .nota-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        padding: 30px 40px;
        margin: 20px 0;
        border: none;
    }
    
    .nota-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 10px;
        text-transform: uppercase;
        text-align: center;
        letter-spacing: 1px;
    }

    .kode-info {
        text-align: center;
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 25px;
        padding: 8px;
        background-color: #f8f9fa;
        border-radius: 6px;
        border: 1px solid #e9ecef;
    }
    
    /* INFORMATION BADGE */
    .info-badge {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border-left: 4px solid #2196f3;
        border-radius: 0 8px 8px 0;
        padding: 15px 20px;
        margin-bottom: 25px;
        color: #1976d2;
    }
    
    /* FORM TABLE & CELLS */
    .nota-table {
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .nota-table td {
        border: none;
        padding: 0 8px;
        vertical-align: top;
    }
    
    .form-label-cell {
        width: 25%;
        font-weight: 600;
        color: #495057;
        padding-top: 12px;
    }

    .colon-cell {
        width: 3%;
        text-align: center;
        padding-top: 12px;
    }
    
    /* INPUTS & EDITABLE INDICATOR */
    .input-group-editable {
        position: relative;
    }
    
    .editable-indicator {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .input-group-editable:hover .editable-indicator {
        opacity: 0.7;
    }
    
    .form-control-custom {
        border: 1px solid #ced4da;
        border-radius: 6px;
        padding: 10px 15px;
        font-size: 15px;
        transition: all 0.3s;
        width: 100%;
    }
    
    .form-control-custom:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    .form-control-custom[readonly] {
        background-color: #eef2f7;
        cursor: not-allowed;
    }

    .form-control-custom[readonly]:hover + .editable-indicator {
        opacity: 0;
    }
    
    /* DYNAMIC ROWS (LEWAT & LAIN-LAIN) */
    .btn-add-row {
        padding: 5px 10px;
        font-size: 12px;
        margin-top: 5px;
        border-radius: 5px;
    }
    
    .btn-remove-row {
        padding: 4px 9px;
        font-size: 12px;
        margin-left: 10px;
        border-radius: 5px;
    }

    .dynamic-row-item {
        margin-bottom: 8px;
    }
    
    /* SIGNATURE SECTION */
    .signature-space {
        height: 80px;
        margin: 15px 0;
    }
    
    /* ACTION BUTTONS */
    .btn-group-custom {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 30px;
        flex-wrap: wrap;
    }
    
    .btn-action {
        padding: 12px 25px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 8px;
        min-width: 200px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }
</style>
@endpush

@section('content')
<div class="container nota-container">
    <div class="card nota-card">
        <div class="nota-header">
            <h2>NOTA PENGAJUAN</h2>
            <div class="kode-info">
                Kode SK: {{ $prosesSk->kodesk }} | 
                @if($prosesSk->nomorSk)
                    Nomor SK: {{ $prosesSk->nomorSk->nosk }}
                @else
                    Nomor SK: Belum Ditentukan
                @endif
            </div>
        </div>
        
        <div class="card-body p-0">
            <form id="notaPengajuanForm" name="form1" method="post" action="#" onsubmit="handlePrint(event)">
                @csrf
                <input type="hidden" name="kodesk" value="{{ $prosesSk->kodesk }}">
                <input type="hidden" name="nosk" value="{{ $prosesSk->nosk ?? '' }}">
                
                <table class="table nota-table">
                    <tr>
                        <td class="form-label-cell">Ditujukan Kepada</td>
                        <td class="colon-cell">:</td>
                        <td>
                            <div class="input-group-editable">
                                <input name="ditujukan_kepada" type="text" class="form-control form-control-custom" 
                                       value="{{ $notaPengajuan->ditujukan_kepada ?? 'Bupati Purworejo' }}">
                                <span class="editable-indicator">
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="form-label-cell">Melalui</td>
                        <td class="colon-cell">:</td>
                        <td>
                            <div class="input-group-editable">
                                <input name="melalui" type="text" class="form-control form-control-custom" 
                                       value="{{ $notaPengajuan->melalui ?? 'Wakil Bupati Purworejo' }}">
                                <span class="editable-indicator">
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                            </div>
                        </td>
                    </tr>
                    
                    @php
                        $lewatData = [];
                        if ($notaPengajuan && $notaPengajuan->lewat) {
                            $lewatLines = explode("\n", $notaPengajuan->lewat);
                            foreach ($lewatLines as $line) {
                                if (trim($line)) {
                                    if (preg_match('/^(\d+\.)\s*(.*)$/', trim($line), $matches)) {
                                        $lewatData[] = ['number' => $matches[1], 'text' => $matches[2]];
                                    } else {
                                        $lewatData[] = ['number' => '', 'text' => trim($line)];
                                    }
                                }
                            }
                        }
                        if (empty($lewatData)) {
                            $lewatData = [
                                ['number' => '1.', 'text' => 'Sekretaris Daerah Kab. Purworejo.'],
                                ['number' => '2.', 'text' => ($prosesSk->asisten->namaass ?? 'Asisten') . ' Setda Kab. Purworejo.']
                            ];
                        }
                    @endphp
                    <tr>
                        <td class="form-label-cell">Lewat</td>
                        <td class="colon-cell">:</td>
                        <td id="lewat-rows-container">
                            @foreach($lewatData as $index => $lewat)
                                <div class="dynamic-row-item d-flex align-items-center" data-index="{{ $index }}">
                                    <input name="lewat_nomor_{{ $index }}" type="text" class="form-control form-control-custom" 
                                           value="{{ $lewat['number'] }}" style="width: 60px;">
                                    <input name="lewat_text_{{ $index }}" type="text" class="form-control form-control-custom ms-2 flex-grow-1" 
                                           value="{{ $lewat['text'] }}">
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="form-label-cell">Dari</td>
                        <td class="colon-cell">:</td>
                        <td>
                            <div class="input-group-editable">
                                <input name="dari" type="text" class="form-control form-control-custom" 
                                       value="{{ $notaPengajuan->dari ?? 'Bagian Hukum Setda Kab. Purworejo' }}">
                                <span class="editable-indicator">
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="form-label-cell">Perihal</td>
                        <td class="colon-cell">:</td>
                        <td>
                            <input name="perihal_prefix" type="text" class="form-control form-control-custom mb-2" 
                                   value="{{ $notaPengajuan->perihal ?? 'Keputusan Bupati Purworejo tentang' }}" readonly>
                            <input name="perihal_judul" type="text" class="form-control form-control-custom" 
                                   value="{{ $prosesSk->judulsk }}" readonly>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="form-label-cell">Mohon untuk</td>
                        <td class="colon-cell">:</td>
                        <td>
                            <div class="input-group-editable">
                                <input name="mohon_untuk" type="text" class="form-control form-control-custom" 
                                       value="{{ $notaPengajuan->mohon_untuk ?? 'Tapak Asman' }}">
                                <span class="editable-indicator">
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="form-label-cell">Tanda Tangan</td>
                        <td class="colon-cell">:</td>
                        <td>
                            <input name="tanda_tangan" type="text" class="form-control form-control-custom" 
                                   value="{{ ($prosesSk->jmlttdsk ?? '1') }} kali" readonly>
                        </td>
                    </tr>
                    
                    @php
                        $lainData = [];
                        if ($notaPengajuan && $notaPengajuan->lain_lain) {
                            $lainLines = explode("\n", $notaPengajuan->lain_lain);
                            foreach ($lainLines as $line) {
                                if (trim($line)) {
                                    if (preg_match('/^(-|\*|•|\d+\.)\s*(.*)$/', trim($line), $matches)) {
                                        $lainData[] = ['prefix' => $matches[1], 'text' => $matches[2]];
                                    } else {
                                        $lainData[] = ['prefix' => '-', 'text' => trim($line)];
                                    }
                                }
                            }
                        }
                        if (empty($lainData)) {
                            $lainData = [
                                ['prefix' => '-', 'text' => 'Materi dari ' . ($prosesSk->opd->namaopd ?? $prosesSk->kodeopd) . ' Kab. Purworejo.'],
                                ['prefix' => '-', 'text' => 'Tata Naskah telah mendapatkan koreksi dan revisi dari Bagian Hukum Setda Kab. Purworejo.']
                            ];
                        }
                    @endphp
                    <tr>
                        <td class="form-label-cell">Lain-lain</td>
                        <td class="colon-cell">:</td>
                        <td id="lain-rows-container">
                            @foreach($lainData as $index => $lain)
                                <div class="dynamic-row-item d-flex align-items-center" data-index="{{ $index }}">
                                    <input name="lain_prefix_{{ $index }}" type="text" class="form-control form-control-custom" 
                                           value="{{ $lain['prefix'] }}" style="width: 60px;">
                                    <input name="lain_text_{{ $index }}" type="text" class="form-control form-control-custom ms-2 flex-grow-1" 
                                           value="{{ $lain['text'] }}">
                                </div>
                            @endforeach
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-center">
                            <div class="float-end w-75">
                                <div class="input-group-editable mt-3">
                                    <input name="tempat_tanggal" type="text" class="form-control form-control-custom text-center" 
                                           value="{{ $notaPengajuan->tempat_tanggal ?? 'Purworejo, ' . date('j F Y') }}">
                                    <span class="editable-indicator">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                </div>
                                <div class="input-group-editable mt-2">
                                    <input name="jabatan_penandatangan" type="text" class="form-control form-control-custom text-center" 
                                           value="{{ $notaPengajuan->jabatan_penandatangan ?? 'KEPALA BAGIAN HUKUM' }}">
                                    <span class="editable-indicator">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                </div>
                                <div class="input-group-editable mt-2">
                                    <input name="instansi_penandatangan" type="text" class="form-control form-control-custom text-center" 
                                           value="{{ $notaPengajuan->instansi_penandatangan ?? 'SETDA KABUPATEN PURWOREJO' }}">
                                    <span class="editable-indicator">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                </div>
                                <div class="signature-space"></div>
                                <div class="input-group-editable">
                                    <input name="nama_penandatangan" type="text" class="form-control form-control-custom text-center fw-bold" 
                                           value="{{ $notaPengajuan->nama_penandatangan ?? 'PUGUH TRIHATMOKO, SH, MH' }}">
                                    <span class="editable-indicator">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                </div>
                                <div class="input-group-editable mt-2">
                                    <input name="pangkat_penandatangan" type="text" class="form-control form-control-custom text-center" 
                                           value="{{ $notaPengajuan->pangkat_penandatangan ?? 'Pembina Tk I' }}">
                                    <span class="editable-indicator">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                </div>
                                <div class="input-group-editable mt-2">
                                    <input name="nip_penandatangan" type="text" class="form-control form-control-custom text-center" 
                                           value="{{ $notaPengajuan->nip_penandatangan ?? 'NIP. 19750829 199903 1 005' }}">
                                    <span class="editable-indicator">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                
                <div class="btn-group-custom">
                    <button type="submit" class="btn btn-primary btn-action">
                        <i class="fas fa-print me-2"></i> Preview & Cetak
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-action" onclick="resetForm()">
                        <i class="fas fa-undo me-2"></i> Reset ke Default
                    </button>
                    <a href="{{ route('sk-proses.detail', $prosesSk->kodesk) }}" class="btn btn-danger btn-action">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Initialize counters from Blade
let lewatCount = {{ count($lewatData) }};
let lainCount = {{ count($lainData) }};

function reindexRows(container, namePrefix) {
    const items = container.querySelectorAll('.dynamic-row-item');
    items.forEach((item, index) => {
        item.setAttribute('data-index', index);
        const inputs = item.querySelectorAll('input');
        const numberInput = item.querySelector(`input[name^="${namePrefix}_nomor_"]`);
        const prefixInput = item.querySelector(`input[name^="${namePrefix}_prefix_"]`);
        const textInput = item.querySelector(`input[name^="${namePrefix}_text_"]`);
        
        if (numberInput) numberInput.name = `${namePrefix}_nomor_${index}`;
        if (prefixInput) prefixInput.name = `${namePrefix}_prefix_${index}`;
        if (textInput) textInput.name = `${namePrefix}_text_${index}`;

        // Auto-numbering for 'lewat' rows
        if (numberInput && numberInput.value.match(/^\d+\.$/)) {
            numberInput.value = `${index + 1}.`;
        }
    });
}

function addLewatRow() {
    const container = document.getElementById('lewat-rows-container');
    const newIndex = container.children.length;
    
    const newItem = document.createElement('div');
    newItem.className = 'dynamic-row-item d-flex align-items-center';
    newItem.setAttribute('data-index', newIndex);
    
    newItem.innerHTML = `
        <input name="lewat_nomor_${newIndex}" type="text" class="form-control form-control-custom" value="${newIndex + 1}." style="width: 60px;">
        <input name="lewat_text_${newIndex}" type="text" class="form-control form-control-custom ms-2 flex-grow-1" value="">
        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row" onclick="removeRow(this)">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(newItem);
    lewatCount++;
    newItem.querySelector('input[name^="lewat_text_"]').focus();
}

function addLainRow() {
    const container = document.getElementById('lain-rows-container');
    const newIndex = container.children.length;

    const newItem = document.createElement('div');
    newItem.className = 'dynamic-row-item d-flex align-items-center';
    newItem.setAttribute('data-index', newIndex);

    newItem.innerHTML = `
        <input name="lain_prefix_${newIndex}" type="text" class="form-control form-control-custom" value="-" style="width: 60px;">
        <input name="lain_text_${newIndex}" type="text" class="form-control form-control-custom ms-2 flex-grow-1" value="">
        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row" onclick="removeRow(this)">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(newItem);
    lainCount++;
    newItem.querySelector('input[name^="lain_text_"]').focus();
}

function removeRow(button) {
    const rowItem = button.closest('.dynamic-row-item');
    const container = rowItem.parentElement;
    
    if (container.children.length <= 1) {
        alert('Minimal harus ada satu baris.');
        return;
    }
    
    const isLewat = container.id === 'lewat-rows-container';
    rowItem.remove();
    
    if (isLewat) {
        lewatCount--;
        reindexRows(container, 'lewat');
    } else {
        lainCount--;
        reindexRows(container, 'lain');
    }
}

function handlePrint(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    
    // Build lewat content
    let lewatContent = '';
    for (let i = 0; i < lewatCount; i++) {
        const number = formData.get(`lewat_nomor_${i}`) || '';
        const text = formData.get(`lewat_text_${i}`) || '';
        if (number || text) {
            lewatContent += `<div>${number} ${text}</div>`;
        }
    }

    // Build lain-lain content
    let lainContent = '';
    for (let i = 0; i < lainCount; i++) {
        const prefix = formData.get(`lain_prefix_${i}`) || '';
        const text = formData.get(`lain_text_${i}`) || '';
        if (prefix || text) {
            lainContent += `<div>${prefix} ${text}</div>`;
        }
    }
    
    // Create print content
    const printContent = `
        <div style="padding: 20px; font-family: Arial, sans-serif; font-size: 12pt;">
            <h2 style="text-align: center; text-transform: uppercase; margin-bottom: 40px; font-size: 14pt;">NOTA PENGAJUAN</h2>
            <table style="width: 100%; border-collapse: collapse; line-height: 1.5;">
                <tr>
                    <td style="width: 22%; vertical-align: top; padding: 5px 0;">Ditujukan Kepada</td>
                    <td style="width: 3%; vertical-align: top; padding: 5px 0;">:</td>
                    <td style="padding: 5px 0;">${formData.get('ditujukan_kepada')}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 5px 0;">Melalui</td>
                    <td style="vertical-align: top; padding: 5px 0;">:</td>
                    <td style="padding: 5px 0;">${formData.get('melalui')}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 5px 0;">Lewat</td>
                    <td style="vertical-align: top; padding: 5px 0;">:</td>
                    <td style="padding: 5px 0;">${lewatContent}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 5px 0;">Dari</td>
                    <td style="vertical-align: top; padding: 5px 0;">:</td>
                    <td style="padding: 5px 0;">${formData.get('dari')}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 5px 0;">Perihal</td>
                    <td style="vertical-align: top; padding: 5px 0;">:</td>
                    <td style="padding: 5px 0;">${formData.get('perihal_prefix')}<br>${formData.get('perihal_judul')}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 5px 0;">Mohon untuk</td>
                    <td style="vertical-align: top; padding: 5px 0;">:</td>
                    <td style="padding: 5px 0;">${formData.get('mohon_untuk')}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 5px 0;">Tanda Tangan</td>
                    <td style="vertical-align: top; padding: 5px 0;">:</td>
                    <td style="padding: 5px 0;">${formData.get('tanda_tangan')}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 5px 0;">Lain-lain</td>
                    <td style="vertical-align: top; padding: 5px 0;">:</td>
                    <td style="padding: 5px 0;">${lainContent}</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div style="width: 50%; float: right; text-align: center; margin-top: 30px;">
                            <div>${formData.get('tempat_tanggal')}</div>
                            <div>${formData.get('jabatan_penandatangan')}</div>
                            <div>${formData.get('instansi_penandatangan')}</div>
                            <div style="height: 80px;"></div>
                            <div style="font-weight: bold;">${formData.get('nama_penandatangan')}</div>
                            <div>${formData.get('pangkat_penandatangan')}</div>
                            <div>${formData.get('nip_penandatangan')}</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    `;
    
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
            <head>
                <title>Nota Pengajuan SK - ${formData.get('kodesk')}</title>
                <style>
                    body { margin: 0; padding: 0; }
                    @media print {
                        @page { margin: 2cm; }
                    }
                </style>
            </head>
            <body>${printContent}</body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    setTimeout(() => { printWindow.print(); }, 500);
}

function resetForm() {
    if (confirm('Apakah Anda yakin ingin mereset form ke nilai default? Perubahan yang belum disimpan akan hilang.')) {
        location.reload();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const firstInput = document.querySelector('input[name="ditujukan_kepada"]');
    if (firstInput) {
        firstInput.focus();
    }
});
</script>
@endpush
@endsection