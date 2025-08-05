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

    public function prosesSk()
    {
        return $this->belongsTo(ProsesSk::class, 'kodesk', 'kodesk');
    }
}