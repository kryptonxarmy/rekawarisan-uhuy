<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Kolom:
 * @property int $id                Primary key
 * @property string $nama           Nama budaya
 * @property string $asal           Daerah asal
 * @property string $pencipta       Pencipta / penggagas
 * @property string $periode        Masa / era
 * @property string $status_unesco  Status pengakuan UNESCO
 * @property string $kategori       Jenis budaya
 * @property string $penampilan     Ciri khas / deskripsi singkat
 * @property \Carbon\Carbon $created_at Waktu dibuat
 */
class FaktaCepat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'asal',
        'pencipta',
        'periode',
        'status_unesco',
        'kategori',
        'penampilan',
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
    ];
}
