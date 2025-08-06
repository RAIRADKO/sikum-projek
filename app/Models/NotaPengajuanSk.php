<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaPengajuanSk extends Model
{
    use HasFactory;

    protected $table = 'nota_pengajuan_sk';
    protected $primaryKey = 'kodesk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kodesk',
        'ditujukan_kepada',
        'melalui',
        'lewat',
        'dari',
        'perihal',
        'mohon_untuk',
        'tanda_tangan',
        'lain_lain',
        'tempat_tanggal',
        'jabatan_penandatangan',
        'instansi_penandatangan',
        'nama_penandatangan',
        'pangkat_penandatangan',
        'nip_penandatangan',
    ];

    /**
     * Cast attributes to appropriate types
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke model ProsesSk
     */
    public function prosesSk()
    {
        return $this->belongsTo(ProsesSk::class, 'kodesk', 'kodesk');
    }

    /**
     * Accessor untuk mendapatkan perihal lengkap
     */
    public function getPerihalLengkapAttribute()
    {
        $prefix = $this->perihal ?: 'Keputusan Bupati Purworejo tentang';
        $judul = $this->prosesSk ? $this->prosesSk->judulsk : '';
        
        return $prefix . ($judul ? "\n" . $judul : '');
    }

    /**
     * Accessor untuk mendapatkan tanda tangan dengan format
     */
    public function getTandaTanganFormatAttribute()
    {
        if ($this->prosesSk && $this->prosesSk->jmlttdsk) {
            return $this->prosesSk->jmlttdsk . ' kali';
        }
        
        return $this->tanda_tangan ?: '1 kali';
    }

    /**
     * Scope untuk mencari berdasarkan kode SK
     */
    public function scopeByKodeSk($query, $kodesk)
    {
        return $query->where('kodesk', $kodesk);
    }

    /**
     * Method untuk membuat nota pengajuan default
     */
    public static function createDefault($kodesk, $prosesSk = null)
    {
        if (!$prosesSk) {
            $prosesSk = ProsesSk::with(['opd', 'asisten'])->find($kodesk);
        }

        $asisteenName = $prosesSk && $prosesSk->asisten 
            ? $prosesSk->asisten->namaass 
            : 'Asisten';

        return new self([
            'kodesk' => $kodesk,
            'ditujukan_kepada' => 'Bupati Purworejo',
            'melalui' => 'Wakil Bupati Purworejo',
            'lewat' => "1. Sekretaris Daerah Kab. Purworejo.\n2. {$asisteenName} Setda Kab. Purworejo.",
            'dari' => 'Bagian Hukum Setda Kab. Purworejo',
            'perihal' => 'Keputusan Bupati Purworejo tentang',
            'mohon_untuk' => 'Tapak Asman',
            'lain_lain' => $prosesSk && $prosesSk->opd 
                ? "- Materi dari {$prosesSk->opd->namaopd} Kab. Purworejo.\n- Tata Naskah telah mendapatkan koreksi dan revisi dari Bagian Hukum Setda Kab. Purworejo."
                : "- Materi dari OPD Kab. Purworejo.\n- Tata Naskah telah mendapatkan koreksi dan revisi dari Bagian Hukum Setda Kab. Purworejo.",
            'tempat_tanggal' => 'Purworejo, ' . now()->locale('id')->translatedFormat('j F Y'),
            'jabatan_penandatangan' => 'KEPALA BAGIAN HUKUM',
            'instansi_penandatangan' => 'SETDA KABUPATEN PURWOREJO',
            'nama_penandatangan' => 'PUGUH TRIHATMOKO, SH, MH',
            'pangkat_penandatangan' => 'Pembina Tk I',
            'nip_penandatangan' => 'NIP. 19750829 199903 1 005',
        ]);
    }
}