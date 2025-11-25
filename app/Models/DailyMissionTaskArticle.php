<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMissionTaskArticle extends Model
{
    use HasFactory;

    protected $table = 'daily_mission_task_articles';

    protected $fillable = [
        'task_id',
        'article_id',
    ];

    /**
     * Get the task that owns this article.
     */
    public function task()
    {
        return $this->belongsTo(DailyMissionTask::class, 'task_id');
    }

    /**
     * Get the article.
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
