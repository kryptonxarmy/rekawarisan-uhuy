<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Mass assignable attributes.
     */
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
        'points',       // ✅ WAJIB! kamu pakai points di controller & badge
        'badge_id',     // relasi badge
    ];

    /**
     * Hidden attributes.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast attributes.
     */
    protected $casts = [
        'id' => 'integer',
        'xp' => 'integer',
        'level' => 'integer',
        'points' => 'integer',      // ✅ WAJIB ADA
        'province' => 'integer',
        'regency' => 'integer',
        'district' => 'integer',
        'badge_id' => 'integer',
        'created_at' => 'datetime',
        'password' => 'hashed',
        'role' => 'string',
    ];

    /**
     * Badge Relationship
     */
    public function badge()
    {
        return $this->belongsTo(\App\Models\Badge::class, 'badge_id');
    }

    /**
     * Check / auto update badge by points
     */
    public function checkBadge()
    {
        $badge = \App\Models\Badge::where('points_requirement', '<=', $this->points)
            ->orderBy('points_requirement', 'desc')
            ->first();

        if ($badge && $this->badge_id != $badge->id) {
            $this->badge_id = $badge->id;
            $this->save();
        }
    }
}
