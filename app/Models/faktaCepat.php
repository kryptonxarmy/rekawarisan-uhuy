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
        'author_id',
        'author_type',
        'is_verified',
        'status',
        'img_url',
    ];

    protected $attributes = [
        'is_verified' => false,
        'status' => 'pending',
    ];

    protected $casts = [
        'id' => 'integer',
        'author_id' => 'integer',
        'is_verified' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'author_type' => 'string',
        'status' => 'string',
    ];

    // Relations
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Accessor untuk image (hanya menggunakan img_url)
    public function getImageUrlAttribute()
    {
        return $this->attributes['img_url'] ?: asset('images/default-fakta-cepat.jpg');
    }

    // Scope untuk filter status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
