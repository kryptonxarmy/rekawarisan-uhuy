<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMissionTask extends Model
{
    use HasFactory;

    protected $table = 'daily_mission_tasks';

    protected $fillable = [
        'daily_mission_id',
        'type',
        'xp_reward',
        'required_count',
        'timer_seconds',
    ];

    protected $casts = [
        'xp_reward' => 'integer',
        'required_count' => 'integer',
        'timer_seconds' => 'integer',
    ];

    /**
     * Get the daily mission that owns this task.
     */
    public function dailyMission()
    {
        return $this->belongsTo(DailyMission::class, 'daily_mission_id');
    }

    /**
     * Get the articles for this task.
     */
    public function articles()
    {
        return $this->hasMany(DailyMissionTaskArticle::class, 'task_id');
    }

    /**
     * Get the quizzes for this task.
     */
    public function quizzes()
    {
        return $this->hasMany(DailyMissionQuiz::class, 'task_id');
    }

    /**
     * Get the user progress for this task.
     */
    public function userProgress()
    {
        return $this->hasMany(DailyMissionUserProgress::class, 'task_id');
    }

    /**
     * Get user progress for a specific user.
     */
    public function userProgressFor($userId)
    {
        return $this->hasOne(DailyMissionUserProgress::class, 'task_id')->where('user_id', $userId);
    }

    /**
     * Check if task is completed by user.
     */
    public function isCompletedBy($userId)
    {
        return $this->userProgress()
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->exists();
    }
}
