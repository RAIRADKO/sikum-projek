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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kodelain',
        'tglmasuk',
        'sedian',
        'judul',
        'status',
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tglmasuk' => 'date',
        'tglnaikkabag' => 'date',
        'tglnaikass' => 'date',
        'tglturun' => 'date',
        'tglambil' => 'date',
    ];

    /**
     * Get the OPD associated with this record.
     */
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'kodeopd', 'kodeopd');
    }

    /**
     * Get the Asisten associated with this record.
     */
    public function asisten()
    {
        return $this->belongsTo(Asisten::class, 'kodeass', 'kodeass');
    }
}
