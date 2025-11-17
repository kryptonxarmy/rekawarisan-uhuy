<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'read_done',
        'share_done',
        'quiz_done',
        'points_today',
    ];
}
