<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMission extends Model
{
    use HasFactory;

    // Tambahkan 'xp_read', 'xp_engage', 'xp_quiz' ke sini
    // Supaya Controller bisa menyimpan data poinnya
    protected $fillable = [
        'date',
        'title',
        'description',
        'user_id',
        'xp_read',   // <--- Tambahan Baru
        'xp_engage', // <--- Tambahan Baru
        'xp_quiz',   // <--- Tambahan Baru
    ];

    protected $casts = [
        'date' => 'datetime', 
    ];

    public function tasks()
    {
        return $this->hasMany(DailyMissionTask::class);
    }
}