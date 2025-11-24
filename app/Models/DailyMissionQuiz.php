<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMissionQuiz extends Model
{
    use HasFactory;

    protected $table = 'daily_mission_quizzes';

    protected $fillable = [
        'task_id',
        'question',
        'explanation',
    ];

    /**
     * Get the task that owns this quiz.
     */
    public function task()
    {
        return $this->belongsTo(DailyMissionTask::class, 'task_id');
    }

    /**
     * Get the options for this quiz.
     */
    public function options()
    {
        return $this->hasMany(DailyMissionQuizOption::class, 'quiz_id');
    }

    /**
     * Get the correct option for this quiz.
     */
    public function correctOption()
    {
        return $this->hasOne(DailyMissionQuizOption::class, 'quiz_id')->where('is_correct', true);
    }
}
