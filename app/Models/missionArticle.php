<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Kolom:
 * @property int $id              Primary key
 * @property int $mission_id      Misi induk
 * @property int $article_id      Artikel yang harus dibaca
 * @property int $min_read_time   Durasi baca minimal (dalam detik atau menit)
 * @property int $order_index     Urutan baca artikel (opsional)
 * @property \Carbon\Carbon $created_at Waktu dibuat
 */
class MissionArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_id',
        'article_id',
        'min_read_time',
        'order_index',
    ];

    protected $casts = [
        'id' => 'integer',
        'mission_id' => 'integer',
        'article_id' => 'integer',
        'min_read_time' => 'integer',
        'order_index' => 'integer',
        'created_at' => 'datetime',
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
