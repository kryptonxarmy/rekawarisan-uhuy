<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMission extends Model
{
    use HasFactory;

    protected $table = 'daily_missions';

    protected $fillable = [
        'date',
        'title',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the tasks for this daily mission.
     */
    public function tasks()
    {
        return $this->hasMany(DailyMissionTask::class, 'daily_mission_id');
    }

    /**
     * Get the read task for this daily mission.
     */
    public function readTask()
    {
        return $this->hasOne(DailyMissionTask::class, 'daily_mission_id')->where('type', 'read');
    }

    /**
     * Get the engage task for this daily mission.
     */
    public function engageTask()
    {
        return $this->hasOne(DailyMissionTask::class, 'daily_mission_id')->where('type', 'engage');
    }

    /**
     * Get the quiz task for this daily mission.
     */
    public function quizTask()
    {
        return $this->hasOne(DailyMissionTask::class, 'daily_mission_id')->where('type', 'quiz');
    }

    /**
     * Get today's daily mission.
     */
    public static function today()
    {
        return self::where('date', today())->with(['tasks.articles.article', 'tasks.quizzes.options'])->first();
    }

    /**
     * Get daily mission by date.
     */
    public static function byDate($date)
    {
        return self::where('date', $date)->with(['tasks.articles.article', 'tasks.quizzes.options'])->first();
    }
}
