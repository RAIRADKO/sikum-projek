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
        'nosk', // Pastikan field ini ada di fillable
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
}