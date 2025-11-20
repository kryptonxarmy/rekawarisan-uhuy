<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDailyMission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mission_id',
        'date',
        'is_completed'
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
