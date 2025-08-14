<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorPerbup extends Model
{
    use HasFactory;

    protected $table = 'nomorpb';
    protected $primaryKey = 'nopb';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = true; // Set to true as per the second snippet

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nopb',
        'tglpb',
        'judulpb',
        'kodeopd',
        'seri',
        'noseri',
        'status',
        'tglpengundangan',
        'tglturunpb',
        'tglambilpb',
        'namapengambilpb',
        'namabon', // Added from second snippet
        'tglbon', // Added from second snippet
        'alasanbonpb', // Added from second snippet
        'ket',
        'kodepb',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tglpb' => 'date',
        'tglpengundangan' => 'date',
        'tglturunpb' => 'date',
        'tglambilpb' => 'date',
        'tglbon' => 'date',
    ];

    /**
     * Get the OPD that owns the Perbup.
     */
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'kodeopd', 'kodeopd');
    }

    /**
     * Get the Seri associated with the Perbup.
     */
    public function seri()
    {
        return $this->belongsTo(Seri::class, 'seri', 'seri');
    }

    /**
     * Get the Proses Perbup records associated with the Nomor Perbup.
     * A "NomorPerbup" can have many "ProsesPerbup" records.
     */
    public function prosesPerbup()
    {
        return $this->hasMany(ProsesPerbup::class, 'nopb', 'nopb');
    }
}
