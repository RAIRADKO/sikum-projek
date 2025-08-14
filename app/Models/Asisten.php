<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asisten extends Model
{
    use HasFactory;

    protected $table = 'asisten';
    protected $primaryKey = 'kodeass';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kodeass',
        'namaass',
    ];

    /**
     * Get the OPDs for the Asisten.
     */
    public function opds()
    {
        return $this->hasMany(Opd::class, 'kodeass', 'kodeass');
    }

    /**
     * Get the Proses Lain records for the Asisten.
     */
    public function prosesLain()
    {
        return $this->hasMany(ProsesLain::class, 'kodeass', 'kodeass');
    }
}
