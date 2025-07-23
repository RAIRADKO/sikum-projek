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

    protected $fillable = [
        'kodeass',
        'namaass',
    ];

    public function opds()
    {
        return $this->hasMany(Opd::class, 'kodeass', 'kodeass');
    }
}