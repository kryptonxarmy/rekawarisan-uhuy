<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Kolom:
 * @property int $id                Primary key
 * @property int $user_id           Pengguna
 * @property string $province       Provinsi pengguna
 * @property string $regency        Kabupaten pengguna
 * @property int $total_points      Total XP / poin
 * @property int $rank              Peringkat di daerahnya
 * @property \Carbon\Carbon $updated_at Terakhir diperbarui
 */
class Leaderboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'province',
        'regency',
        'total_points',
        'rank',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'total_points' => 'integer',
        'rank' => 'integer',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
