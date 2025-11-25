<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMission extends Model
{
    use HasFactory;

    protected $table = 'daily_missions';

    // <<< PERBAIKAN: Menambahkan kolom yang dibutuhkan oleh firstOrCreate di Controller
    protected $fillable = [
        'user_id', // WAJIB untuk firstOrCreate di JejakMaestroController
        'read_done',
        'share_done',
        'quiz_done',
        'points_today',
        'date',
        'title',
        'description',
    ];
    // >>> AKHIR PERBAIKAN

    protected $casts = [
        'date' => 'date',
        // Tambahkan casting jika kolom boolean dan integer
        'read_done' => 'boolean',
        'share_done' => 'boolean',
        'quiz_done' => 'boolean',
        'points_today' => 'integer',
    ];

    /**
     * Get the tasks for this daily mission.
     */
    public function tasks()
    {
        return $this->hasMany(DailyMissionTask::class, 'daily_mission_id');
    }

    // ... (Fungsi relasi lainnya seperti readTask, engageTask, quizTask) ...
    
    public function readTask()
    {
        return $this->hasOne(DailyMissionTask::class, 'daily_mission_id')->where('type', 'read');
    }

    public function engageTask()
    {
        return $this->hasOne(DailyMissionTask::class, 'daily_mission_id')->where('type', 'engage');
    }

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