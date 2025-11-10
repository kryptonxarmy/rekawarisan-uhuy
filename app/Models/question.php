<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Kolom:
 * @property int $id                Primary key
 * @property string $question       Pertanyaan
 * @property string $correct_answer Jawaban benar
 * @property \Carbon\Carbon $created_at Waktu dibuat
 */
class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'correct_answer',
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
    ];
}
