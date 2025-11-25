<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * Tentukan kolom yang bisa diisi (mass assignable).
     * Disusun berdasarkan skema SQL yang diberikan.
     *
     * @var array<int, string>
     */
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

    /**
     * Tentukan apakah model harus menggunakan kolom timestamps (created_at dan updated_at).
     * Secara default, ini adalah true, tapi disertakan untuk kejelasan.
     *
     * @var bool
     */
    public $timestamps = true;

    // Jika nama tabel Anda bukan 'articles', Anda bisa menentukannya di sini:
    // protected $table = 'nama_tabel_artikel';

    /**
     * Relasi ke Category
     * Asumsi Anda memiliki model Category yang terkait dengan category_id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        // Ganti 'Category::class' dengan path model Category Anda jika berbeda
        return $this->belongsTo(ArticleCategory::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class)->with('user')->latest();
    }


    /**
     * Relasi ke Author (pengguna atau model lain yang terkait dengan author_id)
     * Karena Anda memiliki author_id dan author_type, ini mungkin memerlukan Polymorphic Relationship
     * atau relasi BelongsTo sederhana ke model User/Author.
     * Saya asumsikan ini adalah BelongsTo sederhana ke User untuk saat ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        // Ganti 'User::class' dengan path model Author/User Anda jika berbeda
        // Nama kolom relasi yang digunakan di sini adalah author_id
        return $this->belongsTo(User::class, 'author_id');
    }

    // Anda dapat menambahkan relasi dan method lain di sini sesuai kebutuhan.
}