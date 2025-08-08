@extends('layouts.app')

@section('title', 'Nota Pengajuan SK')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pengajuan SK</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* CSS styles remain the same */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card-header {
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
        }
        
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 10px;
            margin-top: 20px;
        }
        
        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-primary {
            background-color: #3498db;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
        }
        
        .btn-danger {
            background-color: #e74c3c;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
        }
        
        table.table-bordered {
            border-collapse: separate;
            border-spacing: 0;
        }
        
        table.table-bordered tr td {
            padding: 12px 15px;
            vertical-align: middle;
        }
        
        table.table-bordered tr:first-child td {
            border-top: 1px solid #dee2e6;
        }
        
        .editable-input:hover {
            background-color: #f8f9fa;
        }
        
        .readonly-input {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
        
        .print-header {
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 40px;
            font-size: 16pt;
            font-weight: bold;
        }
        
        .signature-area {
            margin-top: 80px;
            text-align: center;
        }
        
        .kop-image {
            width: 100%;
            max-width: 800px;
            height: auto;
            display: block;
            margin: 0 auto 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col mt-2" style="min-height: 500px;">
                <div class="card">
                    <h5 class="card-header">NOTA PENGAJUAN</h5>
                    <div class="card-body">
                        <form name="form1" method="post" action="#" onsubmit="handlePrint(event)">
                            <div class="table-responsive">
                                <div class="col">
                                    <table class="table table-bordered">
                                        {{-- ... (baris tabel lainnya tetap sama) ... --}}
                                        <tr>
                                            <td width="20%">Ditujukan Kepada</td>
                                            <td width="3%">:</td>
                                            <td colspan="2">
                                                <input name="tkpd" type="text" id="tkpd" class="form-control editable-input" value="Bupati Purworejo">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Melalui</td>
                                            <td>:</td>
                                            <td colspan="2">
                                                <input name="tmll" type="text" id="tmll" class="form-control editable-input" value="Wakil Bupati Purworejo">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lewat</td>
                                            <td>:</td>
                                            <td width="7%">
                                                <input name="tnomor" type="text" id="tnomor" class="form-control editable-input" value="1.">
                                            </td>
                                            <td>
                                                <input name="tlwt" type="text" id="tlwt" class="form-control editable-input" value="Sekretaris Daerah Kab. Purworejo.">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input name="tnomor2" type="text" id="tnomor2" class="form-control editable-input" value="2.">
                                            </td>
                                            <td>
                                                <input name="tlwt2" type="text" id="tlwt2" class="form-control editable-input" value="Asisten Setda Kab.Purworejo.">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dari</td>
                                            <td>:</td>
                                            <td colspan="2">
                                                <input name="tdari" type="text" id="tdari" class="form-control editable-input" value="Bagian Hukum Setda Kab.Purworejo">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Perihal</td>
                                            <td>:</td>
                                            <td colspan="2">
                                                <input name="tjudul2" type="text" id="tjudul2" class="form-control editable-input" value="Keputusan Bupati Purworejo tentang">
                                                <input name="tjudul" type="text" id="tjudul" class="form-control readonly-input" value="Pengangkatan Pegawai Negeri Sipil" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mohon untuk</td>
                                            <td>:</td>
                                            <td colspan="2">
                                                <input name="tmohon" type="text" id="tmohon" class="form-control editable-input" value="Tapak Asman">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanda Tangan</td>
                                            <td>:</td>
                                            <td colspan="2">
                                                <input name="tttd" type="text" id="tttd" class="form-control readonly-input" value="1 kali" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lain-lain</td>
                                            <td>:</td>
                                            <td width="2%">
                                                <input name="t" type="text" id="t" class="form-control editable-input" value="-">
                                            </td>
                                            <td>
                                                <input name="tlain" type="text" id="tlain" class="form-control editable-input" value="Materi dari Dinas Pendidikan Kab. Purworejo.">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td width="2%">
                                                <input name="t2" type="text" id="t2" class="form-control editable-input" value="-">
                                            </td>
                                            <td>
                                                <input name="tlain2" type="text" id="tlain2" class="form-control editable-input" value="Tata Naskah telah mendapatkan koreksi dan revisi dari Bagian Hukum Setda Kab.Purworejo.">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td width="2%">
                                                <input name="t3" type="text" id="t3" class="form-control editable-input" value="">
                                            </td>
                                            <td>
                                                <input name="tlain3" type="text" id="tlain3" class="form-control editable-input" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2">
                                                <input name="ttgl" type="text" id="ttgl" class="form-control editable-input" value="Purworejo, 8 Agustus 2025">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2">
                                                <input name="tkabag" type="text" id="tkabag" class="form-control editable-input" value="KEPALA BAGIAN HUKUM">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2">
                                                <input name="tkabag2" type="text" id="tkabag2" class="form-control editable-input" value="SETDA KABUPATEN PURWOREJO">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2">
                                                <input name="tkabag3" type="text" id="tkabag3" class="form-control editable-input" value="PUGUH TRIHATMOKO, SH, MH">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2">
                                                <input name="tkabag4" type="text" id="tkabag4" class="form-control editable-input" value="Pembina Tk I">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2">
                                                <input name="tnip" type="text" id="tnip" class="form-control editable-input" value="NIP. 19750829 199903 1 005">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{-- PERBAIKAN: Menggunakan data dinamis dari $prosesSk --}}
                                                <input name="tkode" type="text" id="tkode" size="5%" class="form-control readonly-input" value="{{ $prosesSk->kodesk ?? 'Belum ada kode' }}" readonly>
                                                <input name="tno" type="text" id="tno" size="5%" class="form-control readonly-input" value="{{ $prosesSk->nosk ?? 'Belum ada nomor' }}" readonly>
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
                                                <a href="#" class="btn btn-danger">
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
    const formData = new FormData(event.target);
    
    // Fungsi konversi bulan ke bahasa Inggris
    function convertMonthToEnglish(dateString) {
        const monthMap = {
            'Januari': 'January',
            'Februari': 'February',
            'Maret': 'March',
            'April': 'April',
            'Mei': 'May',
            'Juni': 'June',
            'Juli': 'July',
            'Agustus': 'August',
            'September': 'September',
            'Oktober': 'October',
            'November': 'November',
            'Desember': 'December'
        };
        
        for (const [id, en] of Object.entries(monthMap)) {
            if (dateString.includes(id)) {
                return dateString.replace(id, en);
            }
        }
        return dateString;
    }

    const printContent = `
        <html>
        <head>
            <title>Nota Pengajuan SK</title>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    font-family: 'Bookman Old Style', serif;
                    font-size: 12pt;
                    line-height: 1.5;
                }
                
                @media print {
                    @page { 
                        margin: 2.5cm 1.5cm 2cm; 
                        size: A4;
                    }
                    body { 
                        font-size: 12pt; 
                        line-height: 1.5;
                    }
                }
                
                .header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                
                .header h1 {
                    font-size: 14pt;
                    font-weight: bold;
                    margin: 0;
                    text-transform: uppercase;
                }
                
                .header h2 {
                    font-size: 14pt;
                    font-weight: bold;
                    margin: 0;
                    text-decoration: underline;
                }
                
                .header p {
                    margin: 0;
                    font-size: 10pt;
                }
                
                .judul-nota {
                    text-align: center;
                    font-weight: bold;
                    text-transform: uppercase;
                    font-size: 14pt;
                    margin: 20px 0;
                }
                
                .content {
                    width: 100%;
                    border-collapse: collapse;
                }
                
                .content tr td {
                    vertical-align: top;
                    padding: 3px 0;
                }
                
                .label {
                    width: 25%;
                }
                
                .titik-dua {
                    width: 3%;
                }
                
                .isi {
                    width: 72%;
                }
                
                .signature {
                    margin-top: 60px;
                    float: right;
                    text-align: center;
                    width: 50%;
                }
                
                .signature-name {
                    font-weight: bold;
                    text-decoration: underline;
                    margin-top: 80px;
                }
                
                .document-code {
                    position: absolute;
                    bottom: 20px;
                    right: 20px;
                    font-size: 10pt;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <img src="/img/kop.jpg" alt="Kop Surat" style="width: 100%; max-width: 800px; height: auto; margin-bottom: 20px;">
            </div>
            
            <div class="judul-nota">NOTA DINAS</div>
            
            <table class="content">
                <tr>
                    <td class="label">Ditujukan kepada</td>
                    <td class="titik-dua">:</td>
                    <td class="isi">${formData.get('tkpd')}</td>
                </tr>
                <tr>
                    <td class="label">Melalui</td>
                    <td class="titik-dua">:</td>
                    <td class="isi">${formData.get('tmll')}</td>
                </tr>
                <tr>
                    <td class="label">Lewat</td>
                    <td class="titik-dua">:</td>
                    <td class="isi">
                        ${formData.get('tnomor')} ${formData.get('tlwt')}<br>
                        ${formData.get('tnomor2')} ${formData.get('tlwt2')}
                    </td>
                </tr>
                <tr>
                    <td class="label">Dari</td>
                    <td class="titik-dua">:</td>
                    <td class="isi">${formData.get('tdari')}</td>
                </tr>
                <tr>
                    <td class="label">Perihal</td>
                    <td class="titik-dua">:</td>
                    <td class="isi">
                        ${formData.get('tjudul2')}<br>
                        ${formData.get('tjudul')}
                    </td>
                </tr>
                <tr>
                    <td class="label">Mohon untuk</td>
                    <td class="titik-dua">:</td>
                    <td class="isi">${formData.get('tmohon')}</td>
                </tr>
                <tr>
                    <td class="label">Tanda Tangan</td>
                    <td class="titik-dua">:</td>
                    <td class="isi">${formData.get('tttd')}</td>
                </tr>
                <tr>
                    <td class="label">Lain-lain</td>
                    <td class="titik-dua">:</td>
                    <td class="isi">
                        ${formData.get('t')} ${formData.get('tlain')}<br>
                        ${formData.get('t2')} ${formData.get('tlain2')}<br>
                        ${formData.get('t3')} ${formData.get('tlain3')}
                    </td>
                </tr>
            </table>
            
            <div class="signature">
                <div>${convertMonthToEnglish(formData.get('ttgl'))}</div>
                <div>${formData.get('tkabag')}</div>
                <div>${formData.get('tkabag2')}</div>
                <div class="signature-name">${formData.get('tkabag3')}</div>
                <div>${formData.get('tkabag4')}</div>
                <div>${formData.get('tnip')}</div>
            </div>
            
            <div class="document-code">
                ${formData.get('tkode')}/${formData.get('tno')}
            </div>
            
            <script>
                window.onload = function() {
                    window.print();
                }
            <\/script>
        </body>
        </html>
    `;
    
    const printWindow = window.open('', '_blank');
    printWindow.document.write(printContent);
    printWindow.document.close();
}

        // ... (JavaScript lainnya tetap sama) ...

        // Add some styling for better user experience
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effect to editable inputs
            const editableInputs = document.querySelectorAll('input:not([readonly])');
            editableInputs.forEach(input => {
                input.classList.add('editable-input');
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
                input.classList.add('readonly-input');
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection