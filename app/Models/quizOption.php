<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Kolom:
 * @property int $id                Primary key
 * @property int $quiz_id           Relasi ke quiz
 * @property string $option_text    Pilihan jawaban
 * @property \Carbon\Carbon $created_at Waktu dibuat
 */
class QuizOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'option_text',
    ];

    protected $casts = [
        'id' => 'integer',
        'quiz_id' => 'integer',
        'created_at' => 'datetime',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
