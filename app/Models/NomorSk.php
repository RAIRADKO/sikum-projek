<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorSk extends Model
{
    use HasFactory;

    protected $table = 'nomorsk';
    protected $primaryKey = 'nosk';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nosk',
        'tglsk',
        'judulsk',
        'kodeopd',
        'tglturunsk',
        'tglambilsk',
        'namapengambilsk',
        'namabon',
        'tglbon',
        'alasanbonsk',
        'ket',
        'kodesk',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'kodeopd', 'kodeopd');
    }
}