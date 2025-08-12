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
}