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
                                    <li>Gunakan filter periode untuk melihat laporan berdasarkan waktu tertentu</li>
                                    <li>Filter jenis laporan untuk menampilkan hanya SK, Perbup, atau SK Lainnya</li>
                                    <li>Gunakan kolom pencarian untuk mencari berdasarkan judul dokumen</li>
                                    <li>Klik tombol mata untuk melihat detail laporan</li>
                                    <li>Klik tombol print untuk mencetak laporan yang sudah selesai</li>
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

    .table th {
        border-top: none;
        font-weight: 600;
        background-color: rgba(0,0,0,.02);
    }

    .badge {
        font-size: 0.75em;
    }

    .btn-group .btn {
        border-radius: 0.375rem;
        margin-right: 0.25rem;
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

    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .btn-group .btn {
            margin-bottom: 0.25rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
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

function printDocument(jenis, id) {
    // Implement print functionality based on document type
    let url = '';
    switch(jenis) {
        case 'SK':
            url = `{{ url('/sk/cetak') }}/${id}`;
            break;
        case 'Perbup':
            url = `{{ url('/perbup/cetak') }}/${id}`;
            break;
        case 'SK Lainnya':
            url = `{{ url('/sk-lainnya/cetak') }}/${id}`;
            break;
        default:
            alert('Fungsi cetak belum tersedia untuk jenis dokumen ini');
            return;
    }
    window.open(url, '_blank');
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
</script>
@endsection