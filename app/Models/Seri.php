<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seri extends Model
{
    use HasFactory;

    protected $table = 'seri';
    protected $primaryKey = 'seri';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'seri',
        'kategori',
    ];

    /**
     * Relasi dengan NomorPerbup
     */
    public function nomorPerbup()
    {
        return $this->hasMany(NomorPerbup::class, 'seri', 'seri');
    }
}