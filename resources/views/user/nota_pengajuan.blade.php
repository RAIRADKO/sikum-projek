@extends('layouts.app')

@section('title', 'Nota Pengajuan SK')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0 text-uppercase font-weight-bold">NOTA PENGAJUAN</h5>
                </div>
                <div class="card-body p-4">
                    <form name="form1" method="post" action="#" onsubmit="handlePrint(event)">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="label-col">Ditujukan Kepada</td>
                                        <td class="colon-col">:</td>
                                        <td class="content-col">
                                            <input name="tkpd" type="text" id="tkpd" class="form-control border-0 bg-light" value="Bupati Purworejo">
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-col">Melalui</td>
                                        <td class="colon-col">:</td>
                                        <td class="content-col">
                                            <input name="tmll" type="text" id="tmll" class="form-control border-0 bg-light" value="Wakil Bupati Purworejo">
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-col">Lewat</td>
                                        <td class="colon-col">:</td>
                                        <td class="content-col">
                                            <div class="d-flex align-items-start mb-2">
                                                <input name="tnomor" type="text" id="tnomor" class="form-control border-0 bg-light me-2" style="width: 40px;" value="1.">
                                                <input name="tlwt" type="text" id="tlwt" class="form-control border-0 bg-light flex-grow-1" value="Sekretaris Daerah Kab. Purworejo.">
                                            </div>
                                            <div class="d-flex align-items-start">
                                                <input name="tnomor2" type="text" id="tnomor2" class="form-control border-0 bg-light me-2" style="width: 40px;" value="2.">
                                                <input name="tlwt2" type="text" id="tlwt2" class="form-control border-0 bg-light flex-grow-1" value="{{ $prosesSk->asisten ? $prosesSk->asisten->namaass . ' Setda Kab. Purworejo.' : 'Asisten Perekonomian & Pembangunan Setda Kab.Purworejo.' }}">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-col">Dari</td>
                                        <td class="colon-col">:</td>
                                        <td class="content-col">
                                            <input name="tdari" type="text" id="tdari" class="form-control border-0 bg-light" value="Bagian Hukum Setda Kab.Purworejo">
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-col">Perihal</td>
                                        <td class="colon-col">:</td>
                                        <td class="content-col">
                                            <input name="tjudul2" type="text" id="tjudul2" class="form-control border-0 bg-light mb-2" value="Keputusan Bupati Purworejo tentang" readonly>
                                            <textarea name="tjudul" id="tjudul" class="form-control border-0 bg-light" rows="2" readonly>{{ $prosesSk->judulsk ?? 'Pengangkatan Wiyoto Harjono, S.T sebagai Dewan Pengawas Perusahaan Umum Daerah Air Minum Tirta Perwitasari' }}</textarea>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-col">Mohon untuk</td>
                                        <td class="colon-col">:</td>
                                        <td class="content-col">
                                            <input name="tmohon" type="text" id="tmohon" class="form-control border-0 bg-light" value="Tapak Asman">
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-col">Tanda Tangan</td>
                                        <td class="colon-col">:</td>
                                        <td class="content-col">
                                            <input name="tttd" type="text" id="tttd" class="form-control border-0 bg-light" value="{{ $prosesSk->jmlttdsk ? $prosesSk->jmlttdsk . ' (tiga) kali' : '3 (tiga) kali' }}" readonly>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-col">Lain-lain</td>
                                        <td class="colon-col">:</td>
                                        <td class="content-col">
                                            <div class="d-flex align-items-start mb-2">
                                                <input name="t" type="text" id="t" class="form-control border-0 bg-light me-2" style="width: 30px;" value="-">
                                                <input name="tlain" type="text" id="tlain" class="form-control border-0 bg-light flex-grow-1" value="Materi dari {{ $prosesSk->opd ? $prosesSk->opd->namaopd : 'Bagian Perekonomian & SDA Setda Kab. Purworejo.' }}">
                                            </div>
                                            <div class="d-flex align-items-start mb-2">
                                                <input name="t2" type="text" id="t2" class="form-control border-0 bg-light me-2" style="width: 30px;" value="-">
                                                <input name="tlain2" type="text" id="tlain2" class="form-control border-0 bg-light flex-grow-1" value="Tata Naskah telah mendapatkan koreksi dan revisi dari Bagian Hukum Setda Kab.Purworejo.">
                                            </div>
                                            <div class="d-flex align-items-start">
                                                <input name="t3" type="text" id="t3" class="form-control border-0 bg-light me-2" style="width: 30px;" value="">
                                                <input name="tlain3" type="text" id="tlain3" class="form-control border-0 bg-light flex-grow-1" value="">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Empty rows for spacing -->
                                    <tr><td colspan="3" class="py-3"></td></tr>
                                    
                                    <tr>
                                        <td class="label-col"></td>
                                        <td class="colon-col"></td>
                                        <td class="content-col text-end">
                                            <input name="ttgl" type="text" id="ttgl" class="form-control border-0 bg-light text-center" style="max-width: 300px; margin-left: auto;" value="Purworejo, {{ date('j F Y') }}">
                                        </td>
                                    </tr>
                                    
                                    <tr><td colspan="3" class="py-2"></td></tr>
                                    
                                    <tr>
                                        <td class="label-col"></td>
                                        <td class="colon-col"></td>
                                        <td class="content-col text-center">
                                            <input name="tkabag" type="text" id="tkabag" class="form-control border-0 bg-light text-center font-weight-bold" style="max-width: 400px; margin: 0 auto;" value="KEPALA BAGIAN HUKUM">
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-col"></td>
                                        <td class="colon-col"></td>
                                        <td class="content-col text-center">
                                            <input name="tkabag2" type="text" id="tkabag2" class="form-control border-0 bg-light text-center font-weight-bold" style="max-width: 400px; margin: 0 auto;" value="SETDA KABUPATEN PURWOREJO">
                                        </td>
                                    </tr>
                                    
                                    <!-- Signature space -->
                                    <tr><td colspan="3" class="py-4"></td></tr>
                                    <tr><td colspan="3" class="py-3"></td></tr>
                                    <tr><td colspan="3" class="py-3"></td></tr>
                                    
                                    <tr>
                                        <td class="label-col"></td>
                                        <td class="colon-col"></td>
                                        <td class="content-col text-center">
                                            <input name="tkabag3" type="text" id="tkabag3" class="form-control border-0 bg-light text-center font-weight-bold text-decoration-underline" style="max-width: 400px; margin: 0 auto;" value="PUGUH TRIHATMOKO, SH, MH">
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-col"></td>
                                        <td class="colon-col"></td>
                                        <td class="content-col text-center">
                                            <input name="tkabag4" type="text" id="tkabag4" class="form-control border-0 bg-light text-center" style="max-width: 400px; margin: 0 auto;" value="Pembina Tk I">
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-col"></td>
                                        <td class="colon-col"></td>
                                        <td class="content-col text-center">
                                            <input name="tnip" type="text" id="tnip" class="form-control border-0 bg-light text-center" style="max-width: 400px; margin: 0 auto;" value="NIP. 19750829 199903 1 005">
                                        </td>
                                    </tr>
                                    
                                    <tr><td colspan="3" class="py-3"></td></tr>
                                    
                                    <tr>
                                        <td class="content-col">
                                            <div class="d-flex align-items-center gap-3">
                                                <input name="tkode" type="text" id="tkode" class="form-control border text-center" style="width: 80px;" value="{{ $prosesSk->kodesk }}" readonly>/
                                                @if($prosesSk->nosk)
                                                    <input type="text" class="form-control border text-center" style="width: 60px;" value="{{ $prosesSk->nosk }}" readonly>
                                                @else
                                                    <input type="text" class="form-control border text-center text-muted" style="width: 60px;" value="" placeholder="No SK" readonly>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="colon-col"></td>
                                        <td class="content-col text-end">
                                            <div class="d-flex gap-2 justify-content-end">
                                                <button type="submit" class="btn btn-primary px-4" name="btncetak">
                                                    <i class="fas fa-print me-1"></i> Cetak
                                                </button>
                                                <a href="{{ url()->previous() }}" class="btn btn-danger px-4">
                                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
body {
    background-color: #f8f9fa;
}

.card {
    border-radius: 8px;
}

.card-header {
    background-color: #f8f9fa !important;
    border-bottom: 1px solid #dee2e6;
}

.table-borderless td {
    border: none;
    padding: 8px 12px;
    vertical-align: top;
}

.label-col {
    width: 150px;
    font-weight: 500;
    color: #495057;
}

.colon-col {
    width: 20px;
    text-align: center;
}

.content-col {
    flex: 1;
}

.form-control {
    font-size: 14px;
    padding: 6px 12px;
}

.form-control.border-0 {
    background-color: #f8f9fa !important;
    border: none !important;
    box-shadow: none !important;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.form-control[readonly] {
    background-color: #e9ecef !important;
    opacity: 1;
}

.btn {
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.text-decoration-underline {
    text-decoration: underline !important;
}

@media print {
    body * {
        visibility: hidden;
    }
    
    .print-area, .print-area * {
        visibility: visible;
    }
    
    .print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
}
</style>

<script>
function handlePrint(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    
    // Fungsi untuk membersihkan teks kosong
    function cleanText(text) {
        return text && text.trim() !== '' ? text : '';
    }
    
    // Fungsi untuk membuat baris lain-lain
    function createLainLainRows() {
        let rows = [];
        const items = [
            { marker: formData.get('t'), text: formData.get('tlain') },
            { marker: formData.get('t2'), text: formData.get('tlain2') },
            { marker: formData.get('t3'), text: formData.get('tlain3') }
        ];
        
        items.forEach(item => {
            if (cleanText(item.text)) {
                rows.push(`${cleanText(item.marker)} ${item.text}`);
            }
        });
        
        return rows.join('<br>');
    }

    // Ambil informasi No. SK untuk print
    const nomorSk = '{{ $prosesSk->nosk ?? "" }}';
    const kodeSk = formData.get('tkode');
    const skInfo = nomorSk ? `${kodeSk}/${nomorSk}` : kodeSk;

    const printContent = `
        <html>
        <head>
            <title>Nota Dinas</title>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    font-family: 'Times New Roman', Times, serif;
                    font-size: 12pt;
                    line-height: 1.4;
                    color: #000;
                }
                
                @media print {
                    @page { 
                        margin: 2.5cm 2.5cm 2cm 2.5cm; 
                        size: A4;
                    }
                    body { 
                        font-size: 12pt; 
                        line-height: 1.4;
                        -webkit-print-color-adjust: exact;
                    }
                }
                
                .header-image {
                    width: 100%;
                    height: auto;
                    display: block;
                    margin: 0 auto 20px;
                }
                
                .judul-nota {
                    text-align: center;
                    font-weight: bold;
                    font-size: 12pt;
                    margin: 30px 0 25px 0;
                    letter-spacing: 0.5px;
                }
                
                .content-table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 0;
                }
                
                .content-table td {
                    vertical-align: top;
                    padding: 0;
                    line-height: 1.5;
                    font-size: 12pt;
                }
                
                .content-table tr {
                    height: auto;
                }
                
                .label-col {
                    width: 22%;
                    padding-right: 5px;
                }
                
                .colon-col {
                    width: 2%;
                    text-align: center;
                }
                
                .content-col {
                    width: 76%;
                    padding-left: 5px;
                    text-align: justify;
                }
                
                .row-spacing {
                    height: 8px;
                }
                
                .signature-section {
                    position: absolute;
                    right: 0;
                    top: 0;
                    width: 50%;
                    text-align: center;
                }
                
                .date-location {
                    margin-bottom: 15px;
                    font-size: 12pt;
                }
                
                .position-title {
                    font-weight: bold;
                    font-size: 12pt;
                    text-transform: uppercase;
                    margin-bottom: 3px;
                }
                
                .organization {
                    font-weight: bold;
                    font-size: 12pt;
                    text-transform: uppercase;
                    margin-bottom: 80px;
                }
                
                .signature-name {
                    font-weight: bold;
                    font-size: 12pt;
                    text-decoration: underline;
                    margin-bottom: 3px;
                }
                
                .rank {
                    font-size: 12pt;
                    margin-bottom: 3px;
                }
                
                .nip {
                    font-size: 12pt;
                }
                
                .footer-code {
                    position: absolute;
                    bottom: -15px;
                    left: 0;
                    font-size: 10pt;
                    font-weight: normal;
                }
                
                .signature-container {
                    position: relative;
                    margin-top: 25px;
                    height: 120px;
                }
            </style>
        </head>
        <body>
            <img src="/img/kop.jpg" alt="Kop Surat" class="header-image">
            
            <div class="judul-nota">NOTA DINAS</div>
            
            <table class="content-table">
                <tr>
                    <td class="label-col">Ditujukan Kepada</td>
                    <td class="colon-col">:</td>
                    <td class="content-col">${formData.get('tkpd')}</td>
                </tr>
                <tr class="row-spacing"><td colspan="3"></td></tr>
                
                <tr>
                    <td class="label-col">Melalui</td>
                    <td class="colon-col">:</td>
                    <td class="content-col">${formData.get('tmll')}</td>
                </tr>
                <tr class="row-spacing"><td colspan="3"></td></tr>
                
                <tr>
                    <td class="label-col">Lewat</td>
                    <td class="colon-col">:</td>
                    <td class="content-col">
                        ${formData.get('tnomor')} ${formData.get('tlwt')}<br>
                        ${formData.get('tnomor2')} ${formData.get('tlwt2')}
                    </td>
                </tr>
                <tr class="row-spacing"><td colspan="3"></td></tr>
                
                <tr>
                    <td class="label-col">Dari</td>
                    <td class="colon-col">:</td>
                    <td class="content-col">${formData.get('tdari')}</td>
                </tr>
                <tr class="row-spacing"><td colspan="3"></td></tr>
                
                <tr>
                    <td class="label-col">Perihal</td>
                    <td class="colon-col">:</td>
                    <td class="content-col">
                        ${formData.get('tjudul2')}<br>
                        ${formData.get('tjudul')}
                    </td>
                </tr>
                <tr class="row-spacing"><td colspan="3"></td></tr>
                
                <tr>
                    <td class="label-col">Mohon untuk</td>
                    <td class="colon-col">:</td>
                    <td class="content-col">${formData.get('tmohon')}</td>
                </tr>
                <tr class="row-spacing"><td colspan="3"></td></tr>
                
                <tr>
                    <td class="label-col">Tanda Tangan</td>
                    <td class="colon-col">:</td>
                    <td class="content-col">${formData.get('tttd')}</td>
                </tr>
                <tr class="row-spacing"><td colspan="3"></td></tr>
                
                <tr>
                    <td class="label-col">Lain-lain</td>
                    <td class="colon-col">:</td>
                    <td class="content-col">${createLainLainRows()}</td>
                </tr>
            </table>
            
            <div class="signature-container">
                <div class="signature-section">
                    <div class="date-location">${formData.get('ttgl')}</div>
                    <div class="position-title">${formData.get('tkabag')}</div>
                    <div class="organization">${formData.get('tkabag2')}</div>
                    <div class="signature-name">${formData.get('tkabag3')}</div>
                    <div class="rank">${formData.get('tkabag4')}</div>
                    <div class="nip">${formData.get('tnip')}</div>
                </div>
                
                <div class="footer-code">${skInfo}</div>
            </div>
            
            <script>
                window.onload = function() {
                    setTimeout(() => {
                        window.print();
                    }, 500);
                }
            <\/script>
        </body>
        </html>
    `;
    
    const printWindow = window.open('', '_blank', 'width=800,height=600');
    printWindow.document.write(printContent);
    printWindow.document.close();
}
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection