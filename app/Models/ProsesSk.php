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
        'status', // <-- Tambahkan baris ini
    ];

    /**
     * Relasi ke model Opd
     */
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'kodeopd', 'kodeopd');
    }

    /**
     * Relasi ke model NomorSk untuk mendapatkan status
     */
    public function nomorSk()
    {
        return $this->belongsTo(NomorSk::class, 'nosk', 'nosk');
    }
}