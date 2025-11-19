<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'province',
        'regency',
        'district',
        'role',
        'xp',
        'level',
        'points',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'id' => 'integer',
        'xp' => 'integer',
        'level' => 'integer',
        'points' => 'integer',
        'province' => 'integer',
        'regency' => 'integer',
        'district' => 'integer',
        'created_at' => 'datetime',
        'password' => 'hashed',
        'role' => 'string',
    ];

    // many to many
    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges');
    }

    // cek dan berikan badge otomatis
    public function checkBadge()
    {
        $badges = Badge::orderBy('points_requirement')->get();

        foreach ($badges as $badge) {
            if ($this->points >= $badge->points_requirement) {
                if (!$this->badges()->where('badge_id', $badge->id)->exists()) {
                    $this->badges()->attach($badge->id);
                }
            }
        }
    }
}
