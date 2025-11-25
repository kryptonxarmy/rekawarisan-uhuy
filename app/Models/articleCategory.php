<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Kolom:
 * @property int $id                Primary key
 * @property string $name           Nama kategori artikel
 * @property string $description    Deskripsi kategori
 * @property \Carbon\Carbon $created_at Waktu dibuat
 */
class ArticleCategory extends Model
{
    use HasFactory;

    // Disable timestamps since we only have created_at manually
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'created_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }
}
