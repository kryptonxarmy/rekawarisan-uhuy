<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Kolom:
 * @property int $id                Primary key
 * @property string $name           Nama pengirim
 * @property string $email          Email pengirim
 * @property string $phone          Nomor telepon
 * @property string $message        Isi pesan
 * @property \Carbon\Carbon $created_at Tanggal dibuat
 */
class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
    ];
}
