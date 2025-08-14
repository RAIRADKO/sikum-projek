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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'seri',
        'kategori',
    ];

    /**
     * Get the Nomor Perbup records associated with the Seri.
     */
    public function nomorPerbup()
    {
        return $this->hasMany(NomorPerbup::class, 'seri', 'seri');
    }
}
