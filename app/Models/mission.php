<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = [
        'title', 'description', 'points', 'type',
        'is_active', 'mission_date', 'icon',
        'start_time', 'end_time',
        'related_id', 'related_type'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_daily_missions')
            ->withPivot('is_completed', 'date')
            ->withTimestamps();
    }

    public function progress()
    {
        return $this->hasMany(MissionProgress::class);
    }
}
