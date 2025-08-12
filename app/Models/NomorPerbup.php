<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorPerbup extends Model
{
    use HasFactory;

    protected $table = 'nomorpb';
    protected $primaryKey = 'nopb';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nopb',
        'tglpb',
        'judulpb',
        'kodeopd',
        'seri',
        'noseri',
        'status',
        'tglpengundangan',
        'tglturunpb',
        'tglambilpb',
        'namapengambilpb',
        'ket',
        'kodepb',
    ];

    /**
     * Relasi dengan OPD
     */
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'kodeopd', 'kodeopd');
    }

    /**
     * Relasi dengan Seri
     */
    public function seriModel()
    {
        return $this->belongsTo(Seri::class, 'seri', 'seri');
    }

    /**
     * Relasi dengan ProsesPerbup
     * NomorPerbup hasMany ProsesPerbup (karena satu nomor perbup bisa memiliki beberapa proses)
     */
    public function prosesPerbup()
    {
        return $this->hasMany(ProsesPerbup::class, 'nopb', 'nopb');
    }
}