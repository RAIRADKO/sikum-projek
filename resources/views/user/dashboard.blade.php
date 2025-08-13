@extends('layouts.app')

@section('title', 'Dashboard - SIKUM')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Profil -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm gradient-custom">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <div class="position-relative">
                                    <div class="bg-white rounded-circle p-3 shadow-sm">
                                        <i class="fas fa-user fa-2x text-primary"></i>
                                    </div>
                                    <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-light rounded-circle">
                                        <span class="visually-hidden">Status Online</span>
                                    </span>
                                </div>
                                <div class="ms-3 text-white">
                                    <h3 class="h4 mb-1">{{ $user->nama }}</h3>
                                    <p class="mb-0 opacity-75">
                                        <i class="fas fa-id-card me-2"></i>NIP: {{ $user->nip }}
                                    </p>
                                    <p class="mb-0 opacity-75">
                                        <i class="fas fa-building me-2"></i>{{ $user->opd->namaopd ?? 'OPD Tidak Ditemukan' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <button class="btn btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#profileModal">
                                <i class="fas fa-cog me-1"></i> Pengaturan
                            </button>
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#helpModal">
                                <i class="fas fa-question-circle me-1"></i> Bantuan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifikasi -->
    @if(!empty($notifikasi))
    <div class="row mb-4">
        <div class="col-12">
            @foreach($notifikasi as $notif)
            <div class="alert alert-{{ $notif['type'] }} alert-dismissible fade show" role="alert">
                <i class="{{ $notif['icon'] }} me-2"></i>
                {{ $notif['message'] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Ringkasan Data -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stats-icon bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-file-text text-primary"></i>
                        </div>
                        <span class="badge bg-primary">Total</span>
                    </div>
                    <h3 class="fs-2 mt-3 mb-1">{{ $ringkasan['total_tersedia'] }}</h3>
                    <p class="text-muted mb-0">Laporan Tersedia</p>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-primary" style="width: 100%" role="progressbar"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stats-icon bg-warning bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-clock text-warning"></i>
                        </div>
                        <span class="badge bg-warning">Proses</span>
                    </div>
                    <h3 class="fs-2 mt-3 mb-1">{{ $ringkasan['dalam_proses'] }}</h3>
                    <p class="text-muted mb-0">Dalam Proses</p>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-warning" style="width: 75%" role="progressbar"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stats-icon bg-info bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-download text-info"></i>
                        </div>
                        <span class="badge bg-info">Belum Cetak</span>
                    </div>
                    <h3 class="fs-2 mt-3 mb-1">{{ $ringkasan['belum_dicetak'] }}</h3>
                    <p class="text-muted mb-0">Belum Dicetak</p>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-info" style="width: {{ $ringkasan['belum_dicetak'] > 0 ? 60 : 0 }}%" role="progressbar"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stats-icon bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-chart-line text-success"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Cetak
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="cetakTahunan('semua')">Semua Laporan</a></li>
                                <li><a class="dropdown-item" href="#" onclick="cetakTahunan('sk')">SK Saja</a></li>
                                <li><a class="dropdown-item" href="#" onclick="cetakTahunan('perbup')">Perbup Saja</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#printModal">Cetak Custom</a></li>
                            </ul>
                        </div>
                    </div>
                    <h3 class="fs-2 mt-3 mb-1">{{ date('Y') }}</h3>
                    <p class="text-muted mb-0">Cetak Tahunan</p>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-success" style="width: 90%" role="progressbar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Cetak Laporan -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-print me-2"></i>Menu Cetak Laporan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Nomor SK -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card border h-100 print-menu-card">
                                <div class="card-body text-center">
                                    <div class="print-icon mb-3">
                                        <i class="fas fa-file-alt text-primary fa-3x"></i>
                                    </div>
                                    <h5 class="card-title">Nomor SK</h5>
                                    <p class="card-text text-muted">Cetak dokumen Surat Keputusan berdasarkan tahun dan kategori</p>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" onclick="openPrintModal('sk')">
                                            <i class="fas fa-print me-2"></i>Cetak SK
                                        </button>
                                        <a href="{{ route('sk.index') }}" class="btn btn-outline-primary">
                                            <i class="fas fa-eye me-2"></i>Lihat Daftar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Nomor Perbup -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card border h-100 print-menu-card">
                                <div class="card-body text-center">
                                    <div class="print-icon mb-3">
                                        <i class="fas fa-balance-scale text-success fa-3x"></i>
                                    </div>
                                    <h5 class="card-title">Nomor Perbup</h5>
                                    <p class="card-text text-muted">Cetak dokumen Peraturan Bupati berdasarkan tahun dan seri</p>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-success" onclick="openPrintModal('perbup')">
                                            <i class="fas fa-print me-2"></i>Cetak Perbup
                                        </button>
                                        <a href="{{ route('perbup.index') }}" class="btn btn-outline-success">
                                            <i class="fas fa-eye me-2"></i>Lihat Daftar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SK Lainnya -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card border h-100 print-menu-card">
                                <div class="card-body text-center">
                                    <div class="print-icon mb-3">
                                        <i class="fas fa-folder-open text-warning fa-3x"></i>
                                    </div>
                                    <h5 class="card-title">SK Lainnya</h5>
                                    <p class="card-text text-muted">Cetak dokumen SK lainnya berdasarkan kategori dan status</p>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-warning" onclick="openPrintModal('sk_lainnya')">
                                            <i class="fas fa-print me-2"></i>Cetak SK Lainnya
                                        </button>
                                        <a href="{{ route('sk-lainnya.index') }}" class="btn btn-outline-warning">
                                            <i class="fas fa-eye me-2"></i>Lihat Daftar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('sk.index') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-file-text me-2"></i>
                                <div>Daftar SK</div>
                                <small class="text-muted">Lihat semua SK</small>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('perbup.index') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-balance-scale me-2"></i>
                                <div>Daftar Perbup</div>
                                <small class="text-muted">Lihat semua Perbup</small>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('sk-lainnya.index') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-folder me-2"></i>
                                <div>SK Lainnya</div>
                                <small class="text-muted">Lihat SK lainnya</small>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <button class="btn btn-outline-info w-100" data-bs-toggle="modal" data-bs-target="#printModal">
                                <i class="fas fa-print me-2"></i>
                                <div>Cetak Custom</div>
                                <small class="text-muted">Cetak sesuai filter</small>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Laporan Terbaru Sidebar -->
    @if(!empty($ringkasan['laporan_terbaru']) && $ringkasan['laporan_terbaru']->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-clock me-2"></i>Laporan Terbaru
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($ringkasan['laporan_terbaru'] as $recent)
                        <div class="list-group-item border-0 py-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 text-truncate" style="max-width: 250px;">{{ $recent->judul }}</h6>
                                    <p class="mb-1">
                                        <span class="badge bg-light text-dark">{{ $recent->jenis }}</span>
                                        <span class="badge bg-{{ $recent->status == 'selesai' || $recent->status == 'Selesai' ? 'success' : 'warning' }}">{{ $recent->status }}</span>
                                    </p>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($recent->tanggal)->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Modal Pengaturan Akun -->
<div class="modal fade" id="profileModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-cog me-2"></i>Pengaturan Akun
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Informasi Profil</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" value="{{ $user->nama }}" readonly>
                                    <small class="text-muted">Nama tidak dapat diubah</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">NIP</label>
                                    <input type="text" class="form-control" value="{{ $user->nip }}" readonly>
                                    <small class="text-muted">NIP tidak dapat diubah</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">OPD</label>
                                    <input type="text" class="form-control" value="{{ $user->opd->namaopd ?? 'Tidak ada' }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Ubah Informasi</h6>
                            </div>
                            <div class="card-body">
                                <form id="updateProfileForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">WhatsApp</label>
                                        <input type="text" class="form-control" name="whatsapp" value="{{ $user->whatsapp }}">
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <label class="form-label">Password Lama</label>
                                        <input type="password" class="form-control" name="old_password" placeholder="Kosongkan jika tidak ingin mengubah">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password Baru</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="Kosongkan jika tidak ingin mengubah">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" name="new_password_confirmation" placeholder="Konfirmasi password baru">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="updateProfile()">
                    <i class="fas fa-save me-1"></i>Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bantuan -->
<div class="modal fade" id="helpModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-question-circle me-2"></i>Bantuan & Panduan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="helpAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                Cara Menggunakan Dashboard
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#helpAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li>Gunakan menu cetak laporan untuk mencetak dokumen berdasarkan jenis</li>
                                    <li>Klik "Cetak SK" untuk mencetak Surat Keputusan</li>
                                    <li>Klik "Cetak Perbup" untuk mencetak Peraturan Bupati</li>
                                    <li>Klik "Cetak SK Lainnya" untuk mencetak dokumen SK lainnya</li>
                                    <li>Gunakan "Lihat Daftar" untuk melihat detail dokumen sebelum dicetak</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                Status Laporan
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li><span class="badge bg-warning">Proses</span> - Laporan sedang dalam tahap pemrosesan</li>
                                    <li><span class="badge bg-success">Selesai</span> - Laporan sudah selesai dan dapat dicetak</li>
                                    <li><span class="badge bg-danger">Bon</span> - Laporan menggunakan sistem bon</li>
                                    <li><span class="badge bg-info">Diambil</span> - Laporan sudah diambil/dicetak</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                Kontak Bantuan
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body">
                                <p>Jika mengalami kesulitan, hubungi:</p>
                                <ul>
                                    <li><strong>Bagian Hukum:</strong> (0275) 321234</li>
                                    <li><strong>Email:</strong> hukum@purworejokab.go.id</li>
                                    <li><strong>WhatsApp:</strong> 0812-3456-7890</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cetak Spesifik -->
<div class="modal fade" id="printSpecificModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-print me-2"></i>Cetak <span id="printType"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="printSpecificForm">
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <select name="tahun" class="form-select" required>
                            @for($year = date('Y'); $year >= 2020; $year--)
                                <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3" id="statusFilter">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="semua">Semua Status</option>
                            <option value="selesai">Sudah Selesai</option>
                            <option value="proses">Dalam Proses</option>
                        </select>
                    </div>
                    <div class="mb-3" id="seriFilter" style="display: none;">
                        <label class="form-label">Seri (Khusus Perbup)</label>
                        <select name="seri" class="form-select">
                            <option value="semua">Semua Seri</option>
                            <option value="A">Seri A</option>
                            <option value="B">Seri B</option>
                            <option value="C">Seri C</option>
                            <option value="D">Seri D</option>
                            <option value="E">Seri E</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="cetakSpesifik()">
                    <i class="fas fa-print me-1"></i>Cetak
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cetak Custom -->
<div class="modal fade" id="printModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-print me-2"></i>Cetak Laporan Custom
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="printForm">
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <select name="tahun" class="form-select" required>
                            @for($year = date('Y'); $year >= 2020; $year--)
                                <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Laporan</label>
                        <select name="jenis" class="form-select" required>
                            <option value="semua">Semua Jenis</option>
                            <option value="sk">Surat Keputusan</option>
                            <option value="perbup">Peraturan Bupati</option>
                            <option value="sk_lainnya">SK Lainnya</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="cetakCustom()">
                    <i class="fas fa-print me-1"></i>Cetak
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    body {
        background-color: #f8f9fa;
    }
    
    .gradient-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .card {
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15)!important;
    }

    .stats-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stats-icon i {
        font-size: 1.5rem;
    }

    .print-menu-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .print-menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,.15)!important;
        border-color: var(--bs-primary)!important;
    }

    .print-icon {
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .print-menu-card:hover .print-icon {
        opacity: 1;
        transform: scale(1.1);
    }

    .badge {
        font-size: 0.75em;
    }

    .list-group-item {
        border-left: none;
        border-right: none;
    }

    .list-group-item:first-child {
        border-top: none;
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    .modal-content {
        border-radius: 0.75rem;
    }

    .progress {
        border-radius: 0.25rem;
        overflow: hidden;
    }

    .alert {
        border: none;
        border-radius: 0.75rem;
    }

    .btn-outline-primary:hover,
    .btn-outline-success:hover,
    .btn-outline-warning:hover,
    .btn-outline-info:hover {
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .print-menu-card {
            margin-bottom: 1rem;
        }

        .btn {
            font-size: 0.875rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
let currentPrintType = '';

function cetakTahunan(jenis) {
    const tahun = new Date().getFullYear();
    const url = `{{ route('dashboard') }}/cetak-tahunan?tahun=${tahun}&jenis=${jenis}`;
    window.open(url, '_blank');
}

function cetakCustom() {
    const form = document.getElementById('printForm');
    const formData = new FormData(form);
    const tahun = formData.get('tahun');
    const jenis = formData.get('jenis');
    
    const url = `{{ route('dashboard') }}/cetak-tahunan?tahun=${tahun}&jenis=${jenis}`;
    window.open(url, '_blank');
    
    // Close modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('printModal'));
    modal.hide();
}

function openPrintModal(type) {
    currentPrintType = type;
    const modal = new bootstrap.Modal(document.getElementById('printSpecificModal'));
    
    // Update modal title
    const typeNames = {
        'sk': 'Surat Keputusan',
        'perbup': 'Peraturan Bupati', 
        'sk_lainnya': 'SK Lainnya'
    };
    
    document.getElementById('printType').textContent = typeNames[type] || type.toUpperCase();
    
    // Show/hide specific filters
    const seriFilter = document.getElementById('seriFilter');
    if (type === 'perbup') {
        seriFilter.style.display = 'block';
    } else {
        seriFilter.style.display = 'none';
    }
    
    modal.show();
}

function cetakSpesifik() {
    const form = document.getElementById('printSpecificForm');
    const formData = new FormData(form);
    const tahun = formData.get('tahun');
    const status = formData.get('status');
    const seri = formData.get('seri');
    
    let url = '';
    
    switch(currentPrintType) {
        case 'sk':
            url = `{{ route('sk.index') }}/${tahun}?cetak=1&status=${status}`;
            break;
        case 'perbup':
            url = `{{ route('perbup.index') }}/${tahun}?cetak=1&status=${status}&seri=${seri}`;
            break;
        case 'sk_lainnya':
            url = `{{ route('sk-lainnya.index') }}/${tahun}?cetak=1&status=${status}`;
            break;
        default:
            alert('Jenis cetak tidak valid');
            return;
    }
    
    window.open(url, '_blank');
    
    // Close modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('printSpecificModal'));
    modal.hide();
}

function updateProfile() {
    const form = document.getElementById('updateProfileForm');
    const formData = new FormData(form);
    
    // Add CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    formData.append('_token', csrfToken);
    
    // Show loading state
    const btn = event.target;
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...';
    btn.disabled = true;
    
    fetch('{{ route("dashboard") }}/update-profile', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Profil berhasil diperbarui!');
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('profileModal'));
            modal.hide();
            // Reload page to show updated data
            window.location.reload();
        } else {
            alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data');
    })
    .finally(() => {
        btn.innerHTML = originalText;
        btn.disabled = false;
    });
}

// Auto-refresh notifications every 5 minutes
setInterval(() => {
    fetch('{{ route("dashboard") }}/notifications')
        .then(response => response.json())
        .then(data => {
            // Update notification badges if needed
            if (data.newCount > 0) {
                // Show toast or update UI
                showNewNotification(data.newCount);
            }
        })
        .catch(error => console.error('Error fetching notifications:', error));
}, 300000); // 5 minutes

function showNewNotification(count) {
    const toast = `
        <div class="toast align-items-center text-white bg-info border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-bell me-2"></i>Ada ${count} pembaruan laporan baru
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;
    
    // Add toast to toast container (you need to add this to your layout)
    const toastContainer = document.getElementById('toast-container');
    if (toastContainer) {
        toastContainer.insertAdjacentHTML('beforeend', toast);
        const toastElement = toastContainer.lastElementChild;
        const bsToast = new bootstrap.Toast(toastElement);
        bsToast.show();
    }
}

// Add click event listeners to print menu cards
document.addEventListener('DOMContentLoaded', function() {
    const printCards = document.querySelectorAll('.print-menu-card');
    printCards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Only trigger if not clicking on buttons
            if (!e.target.closest('.btn')) {
                const printBtn = this.querySelector('.btn-primary, .btn-success, .btn-warning');
                if (printBtn) {
                    printBtn.click();
                }
            }
        });
    });
});
</script>
@endsection