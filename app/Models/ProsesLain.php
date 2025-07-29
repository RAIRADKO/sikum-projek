<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesLain extends Model
{
    use HasFactory;

    protected $table = 'proseslain';
    protected $primaryKey = 'kodelain';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kodelain',
        'tglmasuk',
        'sedian',
        'judul',
        'status', // Ditambahkan
        'kodeopd',
        'jmlttd',
        'tglnaikkabag',
        'tglnaikass',
        'kodeass',
        'tglturun',
        'ket',
        'nowa',
        'tglambil',
        'namaambil',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'kodeopd', 'kodeopd');
    }

    public function asisten()
    {
        return $this->belongsTo(Asisten::class, 'kodeass', 'kodeass');
    }
}