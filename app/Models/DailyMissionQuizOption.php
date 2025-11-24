<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMissionQuizOption extends Model
{
    use HasFactory;

    protected $table = 'daily_mission_quiz_options';

    protected $fillable = [
        'quiz_id',
        'option_text',
        'is_correct',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    /**
     * Get the quiz that owns this option.
     */
    public function quiz()
    {
        return $this->belongsTo(DailyMissionQuiz::class, 'quiz_id');
    }
}
