<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Kolom:
 * @property int $id                Primary key
 * @property int $mission_id        Misi quiz
 * @property int $quiz_id           Kuis yang dihubungkan
 * @property int $passing_score     Skor minimal lulus
 * @property \Carbon\Carbon $created_at Waktu dibuat
 */
class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_id',
        'quiz_id',
        'passing_score',
    ];

    protected $casts = [
        'id' => 'integer',
        'mission_id' => 'integer',
        'quiz_id' => 'integer',
        'passing_score' => 'integer',
        'created_at' => 'datetime',
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
