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
        'status',
    ];

    protected $attributes = [
        'like_count' => 0,
        'view_count' => 0,
        'is_verified' => false,
        'status' => 'pending',
    ];

    protected $casts = [
        'id' => 'integer', // gunakan 'string' jika UUID
        'category_id' => 'integer',
        'author_id' => 'integer',
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

    // Accessor untuk image (hanya menggunakan img_url)
    public function getImageUrlAttribute()
    {
        return $this->attributes['img_url'] ?: asset('images/default-article.jpg');
    }

    // Scope untuk filter status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
