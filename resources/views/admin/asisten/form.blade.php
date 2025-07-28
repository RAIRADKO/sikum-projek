<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-user-graduate"></i> Informasi Asisten</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label for="kodeass" class="form-label fw-bold text-secondary">
                        <i class="fas fa-id-card me-2"></i>Kode Asisten
                    </label>
                    <input type="text" 
                           id="kodeass"
                           name="kodeass" 
                           value="{{ old('kodeass', $asisten->kodeass ?? '') }}" 
                           class="form-control form-control-lg border-2" 
                           placeholder="Masukkan kode asisten" 
                           maxlength="10" 
                           required
                           style="border-radius: 10px;">
                    <div class="form-text">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>Maksimal 10 karakter
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label for="namaass" class="form-label fw-bold text-secondary">
                        <i class="fas fa-user me-2"></i>Nama Lengkap Asisten
                    </label>
                    <textarea id="namaass"
                              name="namaass" 
                              class="form-control form-control-lg border-2" 
                              placeholder="Masukkan nama lengkap asisten" 
                              rows="4" 
                              required
                              style="border-radius: 10px; resize: vertical;">{{ old('namaass', $asisten->namaass ?? '') }}</textarea>
                    <div class="form-text">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>Nama lengkap asisten atau deskripsi
                        </small>
                    </div>
                </div>
            </div>
        </div>
        
        <hr class="my-4">
        
        <div class="row">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5 me-3" style="border-radius: 25px;">
                    <i class="fas fa-save me-2"></i>Simpan Data
                </button>
                <a href="{{ route('admin.asisten.index') }}" class="btn btn-outline-secondary btn-lg px-5" style="border-radius: 25px;">
                    <i class="fas fa-times me-2"></i>Batal
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        transform: translateY(-1px);
        transition: all 0.3s ease;
    }
    
    .form-control {
        transition: all 0.3s ease;
    }
    
    .form-control:hover {
        border-color: #86b7fe;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }
    
    .card {
        border: none;
        border-radius: 15px;
    }
    
    .card-header {
        border-radius: 15px 15px 0 0 !important;
        background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
    }
    
    .fw-bold {
        font-weight: 600 !important;
    }
</style>