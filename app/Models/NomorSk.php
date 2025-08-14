<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorSk extends Model
{
    use HasFactory;

    protected $table = 'nomorsk';
    protected $primaryKey = 'nosk';
    public $incrementing = false;
    protected $keyType = 'int'; // Added from the second snippet
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nosk',
        'tglsk',
        'judulsk',
        'kodeopd',
        'tglturunsk',
        'tglambilsk',
        'namapengambilsk',
        'namabon',
        'tglbon',
        'alasanbonsk',
        'ket',
        'kodesk',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tglsk' => 'date',
        'tglturunsk' => 'date',
        'tglambilsk' => 'date',
        'tglbon' => 'date',
    ];

    /**
     * Get the OPD that owns the SK.
     */
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'kodeopd', 'kodeopd');
    }

    /**
     * Get the Proses SK associated with the Nomor SK.
     */
    public function prosesSk()
    {
        return $this->belongsTo(ProsesSk::class, 'kodesk', 'kodesk');
    }
}
