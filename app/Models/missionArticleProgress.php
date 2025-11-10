<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Kolom:
 * @property int $id                      Primary key
 * @property int $mission_progress_id     Progress misi induk
 * @property int $mission_article_id      Artikel dalam misi
 * @property \Carbon\Carbon $start_time  Waktu mulai baca
 * @property \Carbon\Carbon $end_time    Waktu selesai baca
 * @property int $duration_seconds        Lama waktu membaca
 * @property bool $is_completed           True jika durasi ≥ min_read_time
 * @property \Carbon\Carbon $created_at  Waktu dibuat
 */
class MissionArticleProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_progress_id',
        'mission_article_id',
        'start_time',
        'end_time',
        'duration_seconds',
        'is_completed',
    ];

    protected $casts = [
        'id' => 'integer',
        'mission_progress_id' => 'integer',
        'mission_article_id' => 'integer',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'duration_seconds' => 'integer',
        'is_completed' => 'boolean',
        'created_at' => 'datetime',
    ];

    public function missionProgress()
    {
        return $this->belongsTo(MissionProgress::class, 'mission_progress_id');
    }

    public function missionArticle()
    {
        return $this->belongsTo(MissionArticle::class, 'mission_article_id');
    }
}
