<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;

    protected $primaryKey = 'kodeopd';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['namaopd'];

    public function users()
    {
        return $this->hasMany(User::class, 'opd_id', 'kodeopd');
    }
}