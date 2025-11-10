<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'img_url',
        'category_id',
        'province',
        'regency',
        'author_id',
        'author_type',
        'fakta_cepat_id',
        'is_verified',
        'like_count',
        'view_count',
        'status',
    ];

    protected $casts = [
        'id' => 'integer', // gunakan 'string' jika UUID
        'category_id' => 'integer',
        'author_id' => 'integer',
        'fakta_cepat_id' => 'integer',
        'is_verified' => 'boolean',
        'like_count' => 'integer',
        'view_count' => 'integer',
        'created_at' => 'datetime',
        'author_type' => 'string',
        'status' => 'string',
    ];

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function faktaCepat()
    {
        return $this->belongsTo(FaktaCepat::class, 'fakta_cepat_id');
    }
}
