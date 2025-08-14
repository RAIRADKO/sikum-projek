<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;

    protected $table = 'opds';
    protected $primaryKey = 'kodeopd';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true; // Set to true as per the second snippet

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kodeopd',
        'namaopd',
        'kodeass',
    ];

    /**
     * Get the users for the OPD.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'opd_id', 'kodeopd');
    }

    /**
     * Get the Nomor SK records for the OPD.
     */
    public function nomorSk()
    {
        return $this->hasMany(NomorSk::class, 'kodeopd', 'kodeopd');
    }

    /**
     * Get the Nomor Perbup records for the OPD.
     */
    public function nomorPerbup()
    {
        return $this->hasMany(NomorPerbup::class, 'kodeopd', 'kodeopd');
    }

    /**
     * Get the Proses Lain records for the OPD.
     */
    public function prosesLain()
    {
        return $this->hasMany(ProsesLain::class, 'kodeopd', 'kodeopd');
    }

    /**
     * Get the Asisten associated with the OPD.
     */
    public function asisten()
    {
        return $this->belongsTo(Asisten::class, 'kodeass', 'kodeass');
    }
}
