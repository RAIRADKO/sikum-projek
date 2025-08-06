@extends('layouts.app')

@section('title', 'Nota Pengajuan SK')

@push('styles')
<style>
    @media print {
        .no-print { display: none !important; }
        body { font-size: 12pt; margin: 0; padding: 0; }
        .container-fluid { max-width: none; margin: 0; padding: 15px; }
        .card { border: none !important; box-shadow: none !important; }
        .btn-print { display: none; }
        .form-header { display: none; }
    }
    
    .nota-wrapper {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }
    
    .nota-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        padding: 40px;
        margin: 20px 0;
        position: relative;
        overflow: hidden;
    }
    
    .nota-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #007bff, #0056b3);
    }
    
    .nota-header {
        text-align: center;
        margin-bottom: 40px;
        position: relative;
    }
    
    .nota-header h2 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 15px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    
    .nota-header::after {
        content: '';
        display: block;
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, #007bff, #28a745);
        margin: 15px auto;
        border-radius: 2px;
    }
    
    .nota-content {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.8;
        color: #2c3e50;
        font-size: 1rem;
    }
    
    .info-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }
    
    .info-section h5 {
        color: #fff;
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 1.1rem;
    }
    
    .info-item {
        background: rgba(255,255,255,0.1);
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 10px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
    }
    
    .info-item strong {
        color: #fff;
        font-weight: 600;
    }
    
    .nota-table {
        width: 100%;
        margin-bottom: 25px;
        background: #fff;
    }
    
    .nota-table tr {
        transition: all 0.3s ease;
    }
    
    .nota-table tr:hover {
        background: #f8f9ff;
        transform: translateX(5px);
    }
    
    .nota-table td {
        padding: 15px 12px;
        vertical-align: top;
        border: none;
        border-bottom: 1px solid #e9ecef;
    }
    
    .nota-table td:first-child {
        width: 180px;
        font-weight: 600;
        color: #495057;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-right: 3px solid #007bff;
        border-radius: 8px 0 0 8px;
    }
    
    .nota-table td:nth-child(2) {
        width: 30px;
        text-align: center;
        font-weight: bold;
        color: #007bff;
    }
    
    .nota-table td:last-child {
        padding-left: 20px;
        background: #fff;
        border-radius: 0 8px 8px 0;
    }
    
    .underline {
        border-bottom: 2px solid #007bff;
        display: inline-block;
        min-width: 300px;
        padding: 8px 10px;
        background: linear-gradient(135deg, #f8f9ff, #e3f2fd);
        border-radius: 4px;
        font-weight: 500;
        color: #2c3e50;
        transition: all 0.3s ease;
    }
    
    .underline:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(0,123,255,0.2);
    }
    
    .content-section {
        background: #f8f9ff;
        border-left: 5px solid #007bff;
        padding: 25px;
        margin: 25px 0;
        border-radius: 0 10px 10px 0;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
    }
    
    .content-section h6 {
        color: #007bff;
        font-weight: 700;
        margin-bottom: 15px;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .content-section .content-text {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #e3f2fd;
        margin-left: 20px;
        position: relative;
        line-height: 1.7;
    }
    
    .content-text::before {
        content: '"';
        position: absolute;
        top: -10px;
        left: 10px;
        font-size: 3rem;
        color: #007bff;
        opacity: 0.3;
    }
    
    .lain-lain-section {
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        padding: 25px;
        border-radius: 12px;
        margin: 25px 0;
        box-shadow: 0 8px 25px rgba(252, 182, 159, 0.3);
    }
    
    .lain-lain-section h6 {
        color: #8b4513;
        font-weight: 700;
        margin-bottom: 15px;
    }
    
    .lain-lain-item {
        background: rgba(255,255,255,0.7);
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 10px;
        border-left: 4px solid #ff6b6b;
        backdrop-filter: blur(10px);
    }
    
    .signature-section {
        margin-top: 50px;
        text-align: right;
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(168, 237, 234, 0.3);
    }
    
    .signature-box {
        display: inline-block;
        text-align: center;
        min-width: 280px;
        background: rgba(255,255,255,0.9);
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
    }
    
    .signature-box p {
        margin: 8px 0;
        color: #2c3e50;
    }
    
    .signature-line {
        margin: 60px auto 15px;
        border-bottom: 2px solid #2c3e50;
        width: 200px;
        position: relative;
    }
    
    .signature-line::before {
        content: '✎';
        position: absolute;
        right: -25px;
        top: -15px;
        font-size: 1.2rem;
        color: #007bff;
    }
    
    .signature-name {
        font-weight: 700;
        color: #2c3e50;
        text-decoration: underline;
        font-size: 1.1rem;
    }
    
    .btn-print {
        position: fixed;
        top: 120px;
        right: 30px;
        z-index: 1000;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 50px;
        padding: 15px 25px;
        color: white;
        font-weight: 600;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        transition: all 0.3s ease;
    }
    
    .btn-print:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(102, 126, 234, 0.6);
        color: white;
    }
    
    .back-btn {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        border: none;
        border-radius: 50px;
        padding: 12px 25px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
    }
    
    .back-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.5);
        color: white;
    }
    
    .alert-custom {
        background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
        border: none;
        border-radius: 15px;
        color: #2d3436;
        box-shadow: 0 8px 25px rgba(255, 234, 167, 0.4);
        padding: 30px;
    }
    
    .alert-custom h5 {
        color: #2d3436;
        font-weight: 700;
    }
    
    .fade-in {
        animation: fadeIn 0.8s ease-in;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .slide-in {
        animation: slideIn 0.6s ease-out;
    }
    
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-30px); }
        to { opacity: 1; transform: translateX(0); }
    }
</style>
@endpush

@section('content')
<div class="nota-wrapper">
    <div class="container-fluid">
        {{-- Print Button --}}
        <div class="no-print">
            <button onclick="window.print()" class="btn btn-print">
                <i class="bi bi-printer me-2"></i>Cetak Dokumen
            </button>
            
            <div class="row mb-4">
                <div class="col-12">
                    <a href="{{ url()->previous() }}" class="btn back-btn">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-11">
                <div class="nota-card fade-in">
                    {{-- Header Nota --}}
                    <div class="nota-header">
                        <h2>Nota Pengajuan</h2>
                        <p class="text-muted mb-0">Surat Keputusan Bupati Purworejo</p>
                    </div>

                    <div class="nota-content">
                        {{-- Info Section --}}
                        <div class="info-section no-print slide-in">
                            <h5><i class="bi bi-info-circle me-2"></i>Informasi Proses SK</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <strong>Kode SK:</strong> {{ $prosesSk->kodesk }}
                                    </div>
                                    <div class="info-item">
                                        <strong>OPD:</strong> {{ $prosesSk->opd->namaopd ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <strong>Tanggal Masuk:</strong> {{ \Carbon\Carbon::parse($prosesSk->tglmasuksk)->isoFormat('D MMMM YYYY') }}
                                    </div>
                                    <div class="info-item">
                                        <strong>Status:</strong> 
                                        <span class="badge bg-success ms-2">{{ $prosesSk->status ?? 'Proses' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($notaPengajuan)
                            {{-- Content Nota Pengajuan --}}
                            <div class="slide-in">
                                <table class="nota-table">
                                    <tr>
                                        <td><i class="bi bi-person-check me-2"></i>Ditujukan Kepada</td>
                                        <td>:</td>
                                        <td><span class="underline">{{ $notaPengajuan->ditujukan_kepada ?? 'Bupati Purworejo' }}</span></td>
                                    </tr>
                                    <tr>
                                        <td><i class="bi bi-arrow-right me-2"></i>Melalui</td>
                                        <td>:</td>
                                        <td><span class="underline">{{ $notaPengajuan->melalui ?? 'Wakil Bupati Purworejo' }}</span></td>
                                    </tr>
                                </table>

                                <table class="nota-table">
                                    <tr>
                                        <td><i class="bi bi-signpost me-2"></i>Lewat</td>
                                        <td>:</td>
                                        <td>
                                            <div class="content-text">
                                                @if($notaPengajuan->lewat)
                                                    @foreach(explode("\n", $notaPengajuan->lewat) as $index => $lewat)
                                                        <div class="mb-2">
                                                            <span class="badge bg-primary me-2">{{ $index + 1 }}</span>
                                                            {{ trim($lewat) }}
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="mb-2">
                                                        <span class="badge bg-primary me-2">1</span>
                                                        Sekretaris Daerah Kab. Purworejo.
                                                    </div>
                                                    <div>
                                                        <span class="badge bg-primary me-2">2</span>
                                                        Asisten Perekonomian & Pembangunan Setda Kab.Purworejo.
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                                <table class="nota-table">
                                    <tr>
                                        <td><i class="bi bi-building me-2"></i>Dari</td>
                                        <td>:</td>
                                        <td><span class="underline">{{ $notaPengajuan->dari ?? 'Bagian Hukum Setda Kab.Purworejo' }}</span></td>
                                    </tr>
                                </table>

                                <table class="nota-table">
                                    <tr>
                                        <td><i class="bi bi-file-text me-2"></i>Perihal</td>
                                        <td>:</td>
                                        <td><span class="underline">{{ $notaPengajuan->perihal ?? 'Pembentukan Tim Pelaksana Kegiatan Analisis dan Evaluasi Peraturan Perundang-undangan Daerah Kabupaten' }}</span></td>
                                    </tr>
                                </table>

                                <div class="content-section">
                                    <h6><i class="bi bi-hand-thumbs-up me-2"></i>Mohon untuk</h6>
                                    <div class="content-text">
                                        {{ $notaPengajuan->mohon_untuk ?? 'Tapak Asman' }}
                                    </div>
                                </div>

                                <table class="nota-table">
                                    <tr>
                                        <td><i class="bi bi-pen me-2"></i>Tanda Tangan</td>
                                        <td>:</td>
                                        <td><span class="underline">{{ $notaPengajuan->tanda_tangan ?? '3 (tiga) kali' }}</span></td>
                                    </tr>
                                </table>

                                <div class="lain-lain-section">
                                    <h6><i class="bi bi-list-ul me-2"></i>Lain-lain :</h6>
                                    <div class="lain-lain-item">
                                        <i class="bi bi-dot me-1"></i>
                                        {{ $notaPengajuan->lain_lain ?? 'Materi dari BPKPAD Kab. Purworejo.' }}
                                    </div>
                                    <div class="lain-lain-item">
                                        <i class="bi bi-dot me-1"></i>
                                        Tata Naskah telah mendapatkan koreksi dan revisi dari Bagian Hukum Setda Kab.Purworejo.
                                    </div>
                                </div>

                                {{-- Signature Section --}}
                                <div class="signature-section">
                                    <div class="signature-box">
                                        <p><i class="bi bi-geo-alt me-1"></i><strong>{{ $notaPengajuan->tempat_tanggal ?? 'Purworejo, 6 August 2025' }}</strong></p>
                                        <p class="mt-3"><strong>{{ $notaPengajuan->jabatan_penandatangan ?? 'KEPALA BAGIAN HUKUM' }}</strong></p>
                                        <p><strong>{{ $notaPengajuan->instansi_penandatangan ?? 'SETDA KABUPATEN PURWOREJO' }}</strong></p>
                                        
                                        <div class="signature-line"></div>
                                        <p class="signature-name mt-3">{{ $notaPengajuan->nama_penandatangan ?? 'PUGUH TRIHATMOKO, SH, MH' }}</p>
                                        <p class="text-muted">{{ $notaPengajuan->pangkat_penandatangan ?? 'Pembina Tk I' }}</p>
                                        <p class="text-muted">{{ $notaPengajuan->nip_penandatangan ?? 'NIP. 19750829 199903 1 005' }}</p>
                                    </div>
                                </div>
                            </div>

                        @else
                            {{-- Jika belum ada data nota pengajuan --}}
                            <div class="alert alert-custom text-center fade-in" role="alert">
                                <i class="bi bi-exclamation-triangle display-4 mb-3"></i>
                                <h5>Nota Pengajuan Belum Tersedia</h5>
                                <p class="mb-0">Data nota pengajuan untuk SK <strong>{{ $prosesSk->kodesk }}</strong> belum diisi oleh admin.</p>
                                <hr>
                                <small>Nota pengajuan akan tersedia setelah status proses SK diubah menjadi "Selesai" dan admin mengisi data yang diperlukan.</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Add hover effects to table rows
    document.querySelectorAll('.nota-table tr').forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f9ff';
        });
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
});
</script>
@endpush
@endsection