<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesSk extends Model
{
    use HasFactory;

    protected $table = 'prosessk';
    protected $primaryKey = 'kodesk';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'kodesk',
        'tglmasuksk',
        'judulsk',
        'kodeopd',
        'kodeass',
        'jmlttdsk',
        'tglnaikkabag',
        'tglnaikass',
        'tglturunsk',
        'ketprosessk',
        'nowa',
        'nosk',
        'status',
    ];

    protected $dates = [
        'tglmasuksk',
        'tglnaikkabag',
        'tglnaikass',
        'tglturunsk',
        'created_at',
        'updated_at',
    ];

    /**
     * Relasi ke model Opd
     */
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'kodeopd', 'kodeopd');
    }

    /**
     * Relasi ke model Asisten
     */
    public function asisten()
    {
        return $this->belongsTo(Asisten::class, 'kodeass', 'kodeass');
    }

    /**
     * Relasi ke model NomorSk untuk mendapatkan detail SK
     */
    public function nomorSk()
    {
        return $this->belongsTo(NomorSk::class, 'nosk', 'nosk');
    }

    /**
     * Relasi ke model NotaPengajuanSk
     */
    public function notaPengajuan()
    {
        return $this->hasOne(NotaPengajuanSk::class, 'kodesk', 'kodesk');
    }

    /**
     * Accessor untuk mendapatkan status gabungan
     */
    public function getStatusGabunganAttribute()
    {
        $statusProses = $this->status ?? 'Proses';
        $statusSk = $this->nomorSk ? $this->nomorSk->status : null;
        
        return [
            'proses' => $statusProses,
            'sk' => $statusSk
        ];
    }

    /**
     * Accessor untuk mendapatkan nama OPD
     */
    public function getNamaOpdAttribute()
    {
        return $this->opd ? $this->opd->namaopd : $this->kodeopd;
    }

    /**
     * Accessor untuk mendapatkan nama asisten
     */
    public function getNamaAsistenAttribute()
    {
        return $this->asisten ? $this->asisten->namaass : $this->kodeass;
    }

    /**
     * Accessor untuk format tanggal masuk
     */
    public function getTanggalMasukFormatAttribute()
    {
        return $this->tglmasuksk ? $this->tglmasuksk->format('d/m/Y') : '-';
    }

    /**
     * Accessor untuk format jumlah tanda tangan
     */
    public function getJumlahTandaTanganFormatAttribute()
    {
        return $this->jmlttdsk ? $this->jmlttdsk . ' kali' : '1 kali';
    }

    /**
     * Scope untuk filter berdasarkan tahun
     */
    public function scopeByYear($query, $year)
    {
        return $query->whereYear('tglmasuksk', $year);
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('kodesk', 'like', "%{$search}%")
              ->orWhere('judulsk', 'like', "%{$search}%")
              ->orWhere('nosk', 'like', "%{$search}%")
              ->orWhereHas('opd', function ($subQuery) use ($search) {
                  $subQuery->where('namaopd', 'like', "%{$search}%");
              })
              ->orWhereHas('nomorSk', function ($subQuery) use ($search) {
                  $subQuery->where('judulsk', 'like', "%{$search}%");
              });
        });
    }

    /**
     * Scope untuk status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Method untuk mendapatkan atau membuat nota pengajuan
     */
    public function getOrCreateNotaPengajuan()
    {
        if (!$this->notaPengajuan) {
            return NotaPengajuanSk::createDefault($this->kodesk, $this);
        }
        
        return $this->notaPengajuan;
    }

    /**
     * Method untuk mengecek apakah SK sudah selesai
     */
    public function isSelesai()
    {
        return $this->status === 'Selesai';
    }

    /**
     * Method untuk mengecek apakah memiliki nomor SK
     */
    public function hasNomorSk()
    {
        return !is_null($this->nosk) && $this->nomorSk;
    }
}