<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesPerbup extends Model
{
    use HasFactory;

    protected $table = 'prosespb';
    protected $primaryKey = 'kodepb';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kodepb',
        'tglmasukpb',
        'judulpb',
        'kodeopd',
        'status',
        'nopb',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'kodeopd', 'kodeopd');
    }

    /**
     * Relasi dengan NomorPerbup melalui nopb
     * ProsesPerbup belongsTo NomorPerbup
     */
    public function nomorPerbup()
    {
        return $this->belongsTo(NomorPerbup::class, 'nopb', 'nopb');
    }
}