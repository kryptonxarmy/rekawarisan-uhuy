<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMissionUserProgress extends Model
{
    use HasFactory;

    protected $table = 'daily_mission_user_progress';

    protected $fillable = [
        'user_id',
        'task_id',
        'status',
        'completed_at',
        'earned_xp',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'earned_xp' => 'integer',
    ];

    /**
     * Get the user that owns this progress.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the task for this progress.
     */
    public function task()
    {
        return $this->belongsTo(DailyMissionTask::class, 'task_id');
    }

    /**
     * Mark task as completed.
     */
    public function markCompleted()
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now(),
            'earned_xp' => $this->task->xp_reward,
        ]);
    }

    /**
     * Mark task as failed.
     */
    public function markFailed()
    {
        $this->update([
            'status' => 'failed',
            'completed_at' => now(),
            'earned_xp' => 0,
        ]);
    }

    /**
     * Get user's daily mission progress for a specific date.
     */
    public static function userProgressByDate($userId, $date)
    {
        return self::whereHas('task.dailyMission', function ($query) use ($date) {
            $query->where('date', $date);
        })
        ->where('user_id', $userId)
        ->with(['task.dailyMission'])
        ->get();
    }
}
