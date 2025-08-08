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
                                                <input name="tkode" type="text" id="tkode" size="5%" class="form-control readonly-input" value="SK-2025-08-001" readonly>
                                                <input name="tno" type="text" id="tno" size="5%" class="form-control readonly-input" value="001" readonly>
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
            
            // Mengambil semua data dari form
            const formData = new FormData(event.target);
            
            // Membuat konten cetak dengan struktur sama seperti cetaknpsk.php
            const printContent = `
                <html>
                <head>
                    <title>Nota Pengajuan SK</title>
                    <style>
                        body {
                            margin: 0;
                            padding: 20px;
                            font-family: 'Bookman Old Style', serif;
                            font-size: 12pt;
                        }
                        
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
                        
                        .kop-container {
                            text-align: center;
                            margin-bottom: 20px;
                        }
                        
                        .kop-image {
                            width: 100%;
                            max-width: 800px;
                            height: auto;
                        }
                        
                        .print-header {
                            text-align: center;
                            text-transform: uppercase;
                            margin: 20px 0 40px;
                            font-size: 18pt;
                            font-weight: bold;
                        }
                        
                        .content-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 30px;
                        }
                        
                        .content-table td {
                            padding: 8px 0;
                            vertical-align: top;
                        }
                        
                        .content-table td:first-child {
                            width: 25%;
                        }
                        
                        .signature-area {
                            float: right;
                            width: 50%;
                            text-align: center;
                            margin-top: 100px;
                        }
                        
                        .signature-name {
                            font-weight: bold;
                            text-decoration: underline;
                            margin-top: 80px;
                        }
                        
                        .document-code {
                            margin-top: 20px;
                            font-size: 10pt;
                            color: #666;
                        }
                    </style>
                </head>
                <body>
                    <div class="kop-container">
                        <img src="{{ asset('img/kop.jpg') }}" alt="Kop Surat" class="kop-image">
                    </div>
                    
                    <div class="print-header">NOTA PENGAJUAN</div>
                    
                    <table class="content-table">
                        <tr>
                            <td>Ditujukan Kepada</td>
                            <td>:</td>
                            <td>${formData.get('tkpd')}</td>
                        </tr>
                        <tr>
                            <td>Melalui</td>
                            <td>:</td>
                            <td>${formData.get('tmll')}</td>
                        </tr>
                        <tr>
                            <td>Lewat</td>
                            <td>:</td>
                            <td>
                                ${formData.get('tnomor')} ${formData.get('tlwt')}<br>
                                ${formData.get('tnomor2')} ${formData.get('tlwt2')}
                            </td>
                        </tr>
                        <tr>
                            <td>Dari</td>
                            <td>:</td>
                            <td>${formData.get('tdari')}</td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>:</td>
                            <td>
                                ${formData.get('tjudul2')}<br>
                                ${formData.get('tjudul')}
                            </td>
                        </tr>
                        <tr>
                            <td>Mohon untuk</td>
                            <td>:</td>
                            <td>${formData.get('tmohon')}</td>
                        </tr>
                        <tr>
                            <td>Tanda Tangan</td>
                            <td>:</td>
                            <td>${formData.get('tttd')}</td>
                        </tr>
                        <tr>
                            <td>Lain-lain</td>
                            <td>:</td>
                            <td>
                                ${formData.get('t')} ${formData.get('tlain')}<br>
                                ${formData.get('t2')} ${formData.get('tlain2')}<br>
                                ${formData.get('t3')} ${formData.get('tlain3')}
                            </td>
                        </tr>
                    </table>
                    
                    <div class="signature-area">
                        <div>${formData.get('ttgl')}</div>
                        <div>${formData.get('tkabag')}</div>
                        <div>${formData.get('tkabag2')}</div>
                        <div class="signature-name">${formData.get('tkabag3')}</div>
                        <div>${formData.get('tkabag4')}</div>
                        <div>${formData.get('tnip')}</div>
                    </div>
                    
                    <div class="document-code">
                        Kode SK: ${formData.get('tkode')} | No SK: ${formData.get('tno') || 'Belum Ditentukan'}
                    </div>
                    
                    <script>
                        window.onload = function() {
                            window.print();
                        }
                    <\/script>
                </body>
                </html>
            `;
            
            // Membuka jendela baru untuk mencetak
            const printWindow = window.open('', '_blank');
            printWindow.document.write(printContent);
            printWindow.document.close();
        }

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