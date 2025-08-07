@extends('layouts.app')

@section('title', 'Nota Pengajuan SK')

@push('styles')
<style>
    .nota-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        padding: 40px;
        margin: 20px 0;
    }
    .nota-header h2 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 15px;
        text-transform: uppercase;
        text-align: center;
    }
    .nota-table td:first-child {
        width: 180px;
        font-weight: 600;
        color: #495057;
        vertical-align: middle;
    }
    .nota-table td:nth-child(2) {
        width: 30px;
        text-align: center;
        vertical-align: middle;
    }
    .nota-table input[type="text"] {
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 8px 12px;
        font-size: 14px;
    }
    .nota-table input[readonly] {
        background-color: #f8f9fa;
        border-color: #e9ecef;
        color: #495057;
    }
    .btn-group-custom {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 20px;
    }
    .alert-info-custom {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border: 1px solid #2196f3;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 25px;
        color: #1976d2;
    }
    .btn-add-row {
        padding: 4px 8px;
        font-size: 12px;
        margin-left: 5px;
    }
    .btn-remove-row {
        padding: 2px 6px;
        font-size: 10px;
        margin-left: 5px;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col mt-2" style="min-height: 500px;">
            <!-- Alert Information -->
            <div class="alert-info-custom">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle me-2"></i>
                    <div>
                        <strong>Informasi:</strong> Form ini dapat diedit untuk keperluan preview dan cetak. 
                        Perubahan tidak akan disimpan ke database. 
                        Field "Perihal" dan "Tanda Tangan" tidak dapat diubah.
                    </div>
                </div>
            </div>

            <div class="card nota-card">
                <div class="nota-header">
                    <h2>NOTA PENGAJUAN</h2>
                    <div class="text-muted">
                        <small>Kode SK: {{ $prosesSk->kodesk }} | 
                        @if($prosesSk->nomorSk)
                            Nomor SK: {{ $prosesSk->nomorSk->nosk }}
                        @else
                            Nomor SK: Belum Ditentukan
                        @endif
                        </small>
                    </div>
                </div>
                
                <div class="card-body">
                    <form id="notaPengajuanForm" name="form1" method="post" action="#" onsubmit="handlePrint(event)">
                        @csrf
                        <input type="hidden" name="kodesk" value="{{ $prosesSk->kodesk }}">
                        <input type="hidden" name="nosk" value="{{ $prosesSk->nosk ?? '' }}">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered nota-table">
                                <tr>
                                    <td>Ditujukan Kepada</td>
                                    <td>:</td>
                                    <td colspan="2">
                                        <input name="ditujukan_kepada" type="text" class="form-control" 
                                               value="{{ $notaPengajuan->ditujukan_kepada ?? 'Bupati Purworejo' }}">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Melalui</td>
                                    <td>:</td>
                                    <td colspan="2">
                                        <input name="melalui" type="text" class="form-control" 
                                               value="{{ $notaPengajuan->melalui ?? 'Wakil Bupati Purworejo' }}">
                                    </td>
                                </tr>
                                
                                <!-- Dynamic Lewat Rows -->
                                @php
                                    $lewatData = [];
                                    if ($notaPengajuan && $notaPengajuan->lewat) {
                                        $lewatLines = explode("\n", $notaPengajuan->lewat);
                                        foreach ($lewatLines as $line) {
                                            $line = trim($line);
                                            if (!empty($line)) {
                                                // Extract number and text (e.g., "1. Sekretaris..." -> ["1.", "Sekretaris..."])
                                                if (preg_match('/^(\d+\.)\s*(.*)$/', $line, $matches)) {
                                                    $lewatData[] = ['number' => $matches[1], 'text' => $matches[2]];
                                                } else {
                                                    $lewatData[] = ['number' => '', 'text' => $line];
                                                }
                                            }
                                        }
                                    }
                                    
                                    // Default values if no data
                                    if (empty($lewatData)) {
                                        $lewatData = [
                                            ['number' => '1.', 'text' => 'Sekretaris Daerah Kab. Purworejo.'],
                                            ['number' => '2.', 'text' => ($prosesSk->asisten->namaass ?? 'Asisten') . ' Setda Kab. Purworejo.']
                                        ];
                                    }
                                @endphp

                                <tbody id="lewat-rows">
                                    @foreach($lewatData as $index => $lewat)
                                    <tr class="lewat-row" data-index="{{ $index }}">
                                        @if($index == 0)
                                        <td rowspan="{{ count($lewatData) }}" style="vertical-align: top;">
                                            Lewat
                                            <button type="button" class="btn btn-success btn-add-row btn-sm" onclick="addLewatRow()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </td>
                                        <td style="vertical-align: top;">:</td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        @endif
                                        <td width="7%">
                                            <input name="lewat_nomor_{{ $index + 1 }}" type="text" class="form-control" 
                                                   value="{{ $lewat['number'] }}">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input name="lewat_{{ $index + 1 }}" type="text" class="form-control" 
                                                       value="{{ $lewat['text'] }}">
                                                @if($index > 0)
                                                <button type="button" class="btn btn-danger btn-remove-row btn-sm" 
                                                        onclick="removeLewatRow({{ $index }})">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                                <tr>
                                    <td>Dari</td>
                                    <td>:</td>
                                    <td colspan="2">
                                        <input name="dari" type="text" class="form-control" 
                                               value="{{ $notaPengajuan->dari ?? 'Bagian Hukum Setda Kab. Purworejo' }}">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Perihal</td>
                                    <td>:</td>
                                    <td colspan="2">
                                        <input name="perihal_prefix" type="text" class="form-control mb-2" 
                                               value="{{ $notaPengajuan->perihal ?? 'Keputusan Bupati Purworejo tentang' }}" readonly>
                                        <input name="perihal_judul" type="text" class="form-control" 
                                               value="{{ $prosesSk->judulsk }}" readonly>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Mohon untuk</td>
                                    <td>:</td>
                                    <td colspan="2">
                                        <input name="mohon_untuk" type="text" class="form-control" 
                                               value="{{ $notaPengajuan->mohon_untuk ?? 'Tapak Asman' }}">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Tanda Tangan</td>
                                    <td>:</td>
                                    <td colspan="2">
                                        <input name="tanda_tangan" type="text" class="form-control" 
                                               value="{{ ($prosesSk->jmlttdsk ?? '1') }} kali" readonly>
                                    </td>
                                </tr>
                                
                                <!-- Dynamic Lain-lain Rows -->
                                @php
                                    $lainData = [];
                                    if ($notaPengajuan && $notaPengajuan->lain_lain) {
                                        $lainLines = explode("\n", $notaPengajuan->lain_lain);
                                        foreach ($lainLines as $line) {
                                            $line = trim($line);
                                            if (!empty($line)) {
                                                // Extract prefix and text (e.g., "- Materi dari..." -> ["-", "Materi dari..."])
                                                if (preg_match('/^(-|\*|•|\d+\.)\s*(.*)$/', $line, $matches)) {
                                                    $lainData[] = ['prefix' => $matches[1], 'text' => $matches[2]];
                                                } else {
                                                    $lainData[] = ['prefix' => '-', 'text' => $line];
                                                }
                                            }
                                        }
                                    }
                                    
                                    // Default values if no data
                                    if (empty($lainData)) {
                                        $lainData = [
                                            ['prefix' => '-', 'text' => 'Materi dari ' . ($prosesSk->opd->namaopd ?? $prosesSk->kodeopd) . ' Kab. Purworejo.'],
                                            ['prefix' => '-', 'text' => 'Tata Naskah telah mendapatkan koreksi dan revisi dari Bagian Hukum Setda Kab. Purworejo.']
                                        ];
                                    }
                                @endphp

                                <tbody id="lain-rows">
                                    @foreach($lainData as $index => $lain)
                                    <tr class="lain-row" data-index="{{ $index }}">
                                        @if($index == 0)
                                        <td rowspan="{{ count($lainData) }}" style="vertical-align: top;">
                                            Lain-lain
                                            <button type="button" class="btn btn-success btn-add-row btn-sm" onclick="addLainRow()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </td>
                                        <td style="vertical-align: top;">:</td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        @endif
                                        <td>
                                            <input name="lain_prefix_{{ $index + 1 }}" type="text" class="form-control" 
                                                   value="{{ $lain['prefix'] }}">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input name="lain_{{ $index + 1 }}" type="text" class="form-control" 
                                                       value="{{ $lain['text'] }}">
                                                @if($index > 0)
                                                <button type="button" class="btn btn-danger btn-remove-row btn-sm" 
                                                        onclick="removeLainRow({{ $index }})">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2">
                                        <input name="tempat_tanggal" type="text" class="form-control" 
                                               value="{{ $notaPengajuan->tempat_tanggal ?? 'Purworejo, ' . date('j F Y') }}">
                                    </td>
                                </tr>
                                
                                <tr><td></td><td></td><td></td><td></td></tr>
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2">
                                        <input name="jabatan_penandatangan" type="text" class="form-control" 
                                               value="{{ $notaPengajuan->jabatan_penandatangan ?? 'KEPALA BAGIAN HUKUM' }}">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2">
                                        <input name="instansi_penandatangan" type="text" class="form-control" 
                                               value="{{ $notaPengajuan->instansi_penandatangan ?? 'SETDA KABUPATEN PURWOREJO' }}">
                                    </td>
                                </tr>
                                
                                <tr><td></td><td></td><td colspan="2"></td></tr>
                                <tr><td></td><td></td><td colspan="2"></td></tr>
                                <tr><td></td><td></td><td colspan="2"></td></tr>
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2">
                                        <input name="nama_penandatangan" type="text" class="form-control" 
                                               value="{{ $notaPengajuan->nama_penandatangan ?? 'PUGUH TRIHATMOKO, SH, MH' }}">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2">
                                        <input name="pangkat_penandatangan" type="text" class="form-control" 
                                               value="{{ $notaPengajuan->pangkat_penandatangan ?? 'Pembina Tk I' }}">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2">
                                        <input name="nip_penandatangan" type="text" class="form-control" 
                                               value="{{ $notaPengajuan->nip_penandatangan ?? 'NIP. 19750829 199903 1 005' }}">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="btn-group-custom">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-print"></i> Preview & Cetak
                            </button>
                            <button type="button" class="btn btn-secondary btn-lg" onclick="resetForm()">
                                <i class="fas fa-undo"></i> Reset ke Default
                            </button>
                            <a href="{{ route('sk-proses.detail', $prosesSk->kodesk) }}" class="btn btn-danger btn-lg">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let lewatCount = {{ count($lewatData) }};
let lainCount = {{ count($lainData) }};

function addLewatRow() {
    lewatCount++;
    const tbody = document.getElementById('lewat-rows');
    
    // Update rowspan of first cell
    const firstCell = tbody.querySelector('tr:first-child td:first-child');
    firstCell.setAttribute('rowspan', lewatCount);
    
    // Create new row
    const newRow = document.createElement('tr');
    newRow.className = 'lewat-row';
    newRow.setAttribute('data-index', lewatCount - 1);
    
    newRow.innerHTML = `
        <td></td>
        <td></td>
        <td width="7%">
            <input name="lewat_nomor_${lewatCount}" type="text" class="form-control" value="${lewatCount}.">
        </td>
        <td>
            <div class="d-flex align-items-center">
                <input name="lewat_${lewatCount}" type="text" class="form-control" value="">
                <button type="button" class="btn btn-danger btn-remove-row btn-sm" onclick="removeLewatRow(${lewatCount - 1})">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </td>
    `;
    
    tbody.appendChild(newRow);
}

function removeLewatRow(index) {
    const tbody = document.getElementById('lewat-rows');
    const rows = tbody.querySelectorAll('.lewat-row');
    
    if (rows.length <= 1) {
        alert('Minimal harus ada satu baris "Lewat"');
        return;
    }
    
    // Remove the row
    const rowToRemove = tbody.querySelector(`[data-index="${index}"]`);
    if (rowToRemove) {
        rowToRemove.remove();
        lewatCount--;
        
        // Update rowspan
        const firstCell = tbody.querySelector('tr:first-child td:first-child');
        firstCell.setAttribute('rowspan', lewatCount);
        
        // Reindex remaining rows
        reindexLewatRows();
    }
}

function reindexLewatRows() {
    const tbody = document.getElementById('lewat-rows');
    const rows = tbody.querySelectorAll('.lewat-row');
    
    rows.forEach((row, index) => {
        row.setAttribute('data-index', index);
        const numberInput = row.querySelector(`input[name^="lewat_nomor_"]`);
        const textInput = row.querySelector(`input[name^="lewat_"]`);
        
        if (numberInput) {
            numberInput.name = `lewat_nomor_${index + 1}`;
            if (numberInput.value.match(/^\d+\.$/)) {
                numberInput.value = `${index + 1}.`;
            }
        }
        
        if (textInput) {
            textInput.name = `lewat_${index + 1}`;
        }
        
        // Update remove button onclick
        const removeBtn = row.querySelector('.btn-remove-row');
        if (removeBtn) {
            removeBtn.setAttribute('onclick', `removeLewatRow(${index})`);
        }
    });
}

function addLainRow() {
    lainCount++;
    const tbody = document.getElementById('lain-rows');
    
    // Update rowspan of first cell
    const firstCell = tbody.querySelector('tr:first-child td:first-child');
    firstCell.setAttribute('rowspan', lainCount);
    
    // Create new row
    const newRow = document.createElement('tr');
    newRow.className = 'lain-row';
    newRow.setAttribute('data-index', lainCount - 1);
    
    newRow.innerHTML = `
        <td></td>
        <td></td>
        <td>
            <input name="lain_prefix_${lainCount}" type="text" class="form-control" value="-">
        </td>
        <td>
            <div class="d-flex align-items-center">
                <input name="lain_${lainCount}" type="text" class="form-control" value="">
                <button type="button" class="btn btn-danger btn-remove-row btn-sm" onclick="removeLainRow(${lainCount - 1})">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </td>
    `;
    
    tbody.appendChild(newRow);
}

function removeLainRow(index) {
    const tbody = document.getElementById('lain-rows');
    const rows = tbody.querySelectorAll('.lain-row');
    
    if (rows.length <= 1) {
        alert('Minimal harus ada satu baris "Lain-lain"');
        return;
    }
    
    // Remove the row
    const rowToRemove = tbody.querySelector(`[data-index="${index}"]`);
    if (rowToRemove) {
        rowToRemove.remove();
        lainCount--;
        
        // Update rowspan
        const firstCell = tbody.querySelector('tr:first-child td:first-child');
        firstCell.setAttribute('rowspan', lainCount);
        
        // Reindex remaining rows
        reindexLainRows();
    }
}

function reindexLainRows() {
    const tbody = document.getElementById('lain-rows');
    const rows = tbody.querySelectorAll('.lain-row');
    
    rows.forEach((row, index) => {
        row.setAttribute('data-index', index);
        const prefixInput = row.querySelector(`input[name^="lain_prefix_"]`);
        const textInput = row.querySelector(`input[name^="lain_"]`);
        
        if (prefixInput) {
            prefixInput.name = `lain_prefix_${index + 1}`;
        }
        
        if (textInput) {
            textInput.name = `lain_${index + 1}`;
        }
        
        // Update remove button onclick
        const removeBtn = row.querySelector('.btn-remove-row');
        if (removeBtn) {
            removeBtn.setAttribute('onclick', `removeLainRow(${index})`);
        }
    });
}

function handlePrint(event) {
    event.preventDefault();
    
    // Collect form data
    const formData = new FormData(event.target);
    
    // Build lewat content dynamically
    let lewatContent = '';
    let lewatIndex = 1;
    while (formData.get(`lewat_nomor_${lewatIndex}`)) {
        const number = formData.get(`lewat_nomor_${lewatIndex}`) || '';
        const text = formData.get(`lewat_${lewatIndex}`) || '';
        if (number || text) {
            lewatContent += `${number} ${text}<br/>`;
        }
        lewatIndex++;
    }
    
    // Build lain-lain content dynamically
    let lainContent = '';
    let lainIndex = 1;
    while (formData.get(`lain_prefix_${lainIndex}`)) {
        const prefix = formData.get(`lain_prefix_${lainIndex}`) || '';
        const text = formData.get(`lain_${lainIndex}`) || '';
        if (prefix || text) {
            lainContent += `${prefix} ${text}<br/>`;
        }
        lainIndex++;
    }
    
    // Create print content
    let printContent = `
        <div style="padding: 40px; font-family: Arial, sans-serif;">
            <h2 style="text-align: center; text-transform: uppercase; margin-bottom: 30px;">NOTA PENGAJUAN</h2>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 20%; padding: 8px; font-weight: bold;">Ditujukan Kepada</td>
                    <td style="width: 3%; padding: 8px;">:</td>
                    <td style="padding: 8px;">${formData.get('ditujukan_kepada')}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold;">Melalui</td>
                    <td style="padding: 8px;">:</td>
                    <td style="padding: 8px;">${formData.get('melalui')}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold;">Lewat</td>
                    <td style="padding: 8px;">:</td>
                    <td style="padding: 8px;">${lewatContent}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold;">Dari</td>
                    <td style="padding: 8px;">:</td>
                    <td style="padding: 8px;">${formData.get('dari')}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold;">Perihal</td>
                    <td style="padding: 8px;">:</td>
                    <td style="padding: 8px;">${formData.get('perihal_prefix')}<br/>${formData.get('perihal_judul')}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold;">Mohon untuk</td>
                    <td style="padding: 8px;">:</td>
                    <td style="padding: 8px;">${formData.get('mohon_untuk')}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold;">Tanda Tangan</td>
                    <td style="padding: 8px;">:</td>
                    <td style="padding: 8px;">${formData.get('tanda_tangan')}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold;">Lain-lain</td>
                    <td style="padding: 8px;">:</td>
                    <td style="padding: 8px;">${lainContent}</td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 20px; text-align: right;">
                        <div style="margin-bottom: 80px;">${formData.get('tempat_tanggal')}</div>
                        <div style="margin-bottom: 10px;">${formData.get('jabatan_penandatangan')}</div>
                        <div style="margin-bottom: 80px;">${formData.get('instansi_penandatangan')}</div>
                        <div style="margin-bottom: 10px;">${formData.get('nama_penandatangan')}</div>
                        <div style="margin-bottom: 10px;">${formData.get('pangkat_penandatangan')}</div>
                        <div>${formData.get('nip_penandatangan')}</div>
                    </td>
                </tr>
            </table>
        </div>
    `;
    
    // Open print window
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
            <body>
                ${printContent}
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    
    setTimeout(() => {
        printWindow.print();
    }, 250);
}

function resetForm() {
    if (confirm('Apakah Anda yakin ingin mereset form ke nilai default?')) {
        location.reload();
    }
}

// Auto-focus first input when page loads
document.addEventListener('DOMContentLoaded', function() {
    const firstInput = document.querySelector('input[name="ditujukan_kepada"]');
    if (firstInput) {
        firstInput.focus();
    }
});
</script>
@endpush
@endsection