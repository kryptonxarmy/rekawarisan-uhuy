<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionProgress extends Model
{
    use HasFactory;

    /**
     * Kolom:
     * @property int $id                Primary key
     * @property int $user_id           Pengguna
     * @property int $mission_id        Misi yang sedang dijalankan
     * @property string $status         Status misi
     * @property int $progress_count    Jumlah artikel yang sudah dibaca sesuai ketentuan
     * @property int $total_required    Jumlah total artikel di misi
     * @property \Carbon\Carbon|null $completed_at Waktu selesai semua artikel
     * @property \Carbon\Carbon|null $claimed_at   Waktu user claim XP
     * @property \Carbon\Carbon $updated_at        Update terakhir
     */

    protected $fillable = [
        'user_id',
        'mission_id',
        'status',
        'progress_count',
        'total_required',
        'completed_at',
        'claimed_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'mission_id' => 'integer',
        'progress_count' => 'integer',
        'total_required' => 'integer',
        'completed_at' => 'datetime',
        'claimed_at' => 'datetime',
        'updated_at' => 'datetime',
        'status' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }
}
