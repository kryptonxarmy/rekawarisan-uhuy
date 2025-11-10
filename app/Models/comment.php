<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Kolom:
 * @property int $id                Primary key
 * @property int $article_id        Artikel yang dikomentari
 * @property int $user_id           Pengirim komentar
 * @property string $content        Isi komentar
 * @property int $like_count        Jumlah suka komentar
 * @property \Carbon\Carbon $created_at Tanggal dibuat
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'user_id',
        'content',
        'like_count',
    ];

    protected $casts = [
        'id' => 'integer',
        'article_id' => 'integer',
        'user_id' => 'integer',
        'like_count' => 'integer',
        'created_at' => 'datetime',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
