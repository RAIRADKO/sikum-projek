@extends('layouts.app')

@section('title', 'Nota Pengajuan SK')

@section('content')
<div class="container">
    <div class="row">
        <div class="col mt-2" style="min-height: 500px;">
            <div class="card">
                <h5 class="card-header">NOTA PENGAJUAN</h5>
                <div class="card-body">
                    <form name="form1" method="post" action="#" onsubmit="handlePrint(event)">
                        @csrf
                        <div class="table-responsive">
                            <div class="col">
                                <table class="table table-bordered">
                                    <tr>
                                        <td width="20%">Ditujukan Kepada</td>
                                        <td width="3%">:</td>
                                        <td colspan="2">
                                            <input name="tkpd" type="text" id="tkpd" class="form-control" value="Bupati Purworejo">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Melalui</td>
                                        <td>:</td>
                                        <td colspan="2">
                                            <input name="tmll" type="text" id="tmll" class="form-control" value="Wakil Bupati Purworejo">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lewat</td>
                                        <td>:</td>
                                        <td width="7%">
                                            <input name="tnomor" type="text" id="tnomor" class="form-control" value="1.">
                                        </td>
                                        <td>
                                            <input name="tlwt" type="text" id="tlwt" class="form-control" value="Sekretaris Daerah Kab. Purworejo.">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input name="tnomor2" type="text" id="tnomor2" class="form-control" value="2.">
                                        </td>
                                        <td>
                                            <input name="tlwt2" type="text" id="tlwt2" class="form-control" value="{{ $prosesSk->asisten->namaass ?? 'Asisten' }} Setda Kab.Purworejo.">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dari</td>
                                        <td>:</td>
                                        <td colspan="2">
                                            <input name="tdari" type="text" id="tdari" class="form-control" value="Bagian Hukum Setda Kab.Purworejo">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Perihal</td>
                                        <td>:</td>
                                        <td colspan="2">
                                            <input name="tjudul2" type="text" id="tjudul2" class="form-control" value="Keputusan Bupati Purworejo tentang">
                                            <input name="tjudul" type="text" id="tjudul" class="form-control" value="{{ $prosesSk->judulsk }}" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mohon untuk</td>
                                        <td>:</td>
                                        <td colspan="2">
                                            <input name="tmohon" type="text" id="tmohon" class="form-control" value="Tapak Asman">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanda Tangan</td>
                                        <td>:</td>
                                        <td colspan="2">
                                            <input name="tttd" type="text" id="tttd" class="form-control" value="{{ $prosesSk->jmlttdsk ?? '1' }} kali" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lain-lain</td>
                                        <td>:</td>
                                        <td width="2%">
                                            <input name="t" type="text" id="t" class="form-control" value="-">
                                        </td>
                                        <td>
                                            <input name="tlain" type="text" id="tlain" class="form-control" value="Materi dari {{ $prosesSk->opd->namaopd ?? $prosesSk->kodeopd }} Kab. Purworejo.">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td width="2%">
                                            <input name="t2" type="text" id="t2" class="form-control" value="-">
                                        </td>
                                        <td>
                                            <input name="tlain2" type="text" id="tlain2" class="form-control" value="Tata Naskah telah mendapatkan koreksi dan revisi dari Bagian Hukum Setda Kab.Purworejo.">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td width="2%">
                                            <input name="t3" type="text" id="t3" class="form-control" value="">
                                        </td>
                                        <td>
                                            <input name="tlain3" type="text" id="tlain3" class="form-control" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">
                                            <input name="ttgl" type="text" id="ttgl" class="form-control" value="Purworejo, {{ date('j F Y') }}">
                                        </td>
                                    </tr>
                                    <tr><td></td><td></td><td></td></tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">
                                            <input name="tkabag" type="text" id="tkabag" class="form-control" value="KEPALA BAGIAN HUKUM">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">
                                            <input name="tkabag2" type="text" id="tkabag2" class="form-control" value="SETDA KABUPATEN PURWOREJO">
                                        </td>
                                    </tr>
                                    <tr><td></td><td></td><td colspan="2"></td></tr>
                                    <tr><td></td><td></td><td colspan="2"></td></tr>
                                    <tr><td></td><td></td><td colspan="2"></td></tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">
                                            <input name="tkabag3" type="text" id="tkabag3" class="form-control" value="PUGUH TRIHATMOKO, SH, MH">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">
                                            <input name="tkabag4" type="text" id="tkabag4" class="form-control" value="Pembina Tk I">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">
                                            <input name="tnip" type="text" id="tnip" class="form-control" value="NIP. 19750829 199903 1 005">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input name="tkode" type="text" id="tkode" size="5%" value="{{ $prosesSk->kodesk }}" readonly>
                                            <input name="tno" type="text" id="tno" size="5%" value="{{ $prosesSk->nosk ?? '' }}" readonly>
                                        </td>
                                        <td></td>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">
                                            <button type="submit" class="btn btn-primary" name="btncetak">
                                                <i class="fa fa-print"></i> Cetak
                                            </button>
                                            <a href="{{ route('sk-proses.detail', $prosesSk->kodesk) }}" class="btn btn-danger">
                                                <i class="fa fa-reply"></i> Kembali
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function handlePrint(event) {
    event.preventDefault();
    
    // Get form data
    const formData = new FormData(event.target);
    
    // Create print content that matches the original structure
    const printContent = `
        <div style="padding: 40px; font-family: Arial, sans-serif; font-size: 12pt; line-height: 1.4;">
            <h2 style="text-align: center; text-transform: uppercase; margin-bottom: 40px; font-size: 16pt; font-weight: bold;">NOTA PENGAJUAN</h2>
            
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 20%; vertical-align: top; padding: 8px 0;">Ditujukan Kepada</td>
                    <td style="width: 3%; vertical-align: top; padding: 8px 0; text-align: center;">:</td>
                    <td style="padding: 8px 0;">${formData.get('tkpd')}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 8px 0;">Melalui</td>
                    <td style="vertical-align: top; padding: 8px 0; text-align: center;">:</td>
                    <td style="padding: 8px 0;">${formData.get('tmll')}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 8px 0;">Lewat</td>
                    <td style="vertical-align: top; padding: 8px 0; text-align: center;">:</td>
                    <td style="padding: 8px 0;">
                        ${formData.get('tnomor')} ${formData.get('tlwt')}<br>
                        ${formData.get('tnomor2')} ${formData.get('tlwt2')}
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 8px 0;">Dari</td>
                    <td style="vertical-align: top; padding: 8px 0; text-align: center;">:</td>
                    <td style="padding: 8px 0;">${formData.get('tdari')}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 8px 0;">Perihal</td>
                    <td style="vertical-align: top; padding: 8px 0; text-align: center;">:</td>
                    <td style="padding: 8px 0;">
                        ${formData.get('tjudul2')}<br>
                        ${formData.get('tjudul')}
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 8px 0;">Mohon untuk</td>
                    <td style="vertical-align: top; padding: 8px 0; text-align: center;">:</td>
                    <td style="padding: 8px 0;">${formData.get('tmohon')}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 8px 0;">Tanda Tangan</td>
                    <td style="vertical-align: top; padding: 8px 0; text-align: center;">:</td>
                    <td style="padding: 8px 0;">${formData.get('tttd')}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 8px 0;">Lain-lain</td>
                    <td style="vertical-align: top; padding: 8px 0; text-align: center;">:</td>
                    <td style="padding: 8px 0;">
                        ${formData.get('t') ? formData.get('t') + ' ' + formData.get('tlain') : ''}
                        ${formData.get('tlain') ? '<br>' : ''}
                        ${formData.get('t2') ? formData.get('t2') + ' ' + formData.get('tlain2') : ''}
                        ${formData.get('tlain2') ? '<br>' : ''}
                        ${formData.get('t3') && formData.get('tlain3') ? formData.get('t3') + ' ' + formData.get('tlain3') : ''}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-top: 40px;">
                        <div style="width: 50%; float: right; text-align: center;">
                            <div style="margin-bottom: 10px;">${formData.get('ttgl')}</div>
                            <div style="margin-bottom: 5px;">${formData.get('tkabag')}</div>
                            <div style="margin-bottom: 80px;">${formData.get('tkabag2')}</div>
                            <div style="font-weight: bold; text-decoration: underline; margin-bottom: 5px;">${formData.get('tkabag3')}</div>
                            <div style="margin-bottom: 5px;">${formData.get('tkabag4')}</div>
                            <div>${formData.get('tnip')}</div>
                        </div>
                    </td>
                </tr>
            </table>
            
            <div style="margin-top: 20px; font-size: 10pt; color: #666;">
                Kode SK: ${formData.get('tkode')} | No SK: ${formData.get('tno') || 'Belum Ditentukan'}
            </div>
        </div>
    `;
    
    // Open print window
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
            <head>
                <title>Nota Pengajuan SK - ${formData.get('tkode')}</title>
                <style>
                    body { margin: 0; padding: 0; }
                    @media print {
                        @page { 
                            margin: 2cm; 
                            size: A4;
                        }
                        body { 
                            font-size: 12pt; 
                            line-height: 1.4;
                        }
                    }
                </style>
            </head>
            <body>${printContent}</body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    setTimeout(() => { 
        printWindow.print(); 
    }, 500);
}

// Add some styling for better user experience
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effect to editable inputs
    const editableInputs = document.querySelectorAll('input:not([readonly])');
    editableInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.backgroundColor = '#fff3cd';
            this.style.borderColor = '#ffeaa7';
        });
        
        input.addEventListener('blur', function() {
            this.style.backgroundColor = '';
            this.style.borderColor = '';
        });
    });
    
    // Add readonly styling
    const readonlyInputs = document.querySelectorAll('input[readonly]');
    readonlyInputs.forEach(input => {
        input.style.backgroundColor = '#e9ecef';
        input.style.cursor = 'not-allowed';
    });
});
</script>
@endsection