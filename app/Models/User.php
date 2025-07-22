<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'nip',
        'whatsapp',
        'opd_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}