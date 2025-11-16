<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Panel;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
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
        'badge_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'xp' => 'integer',
        'level' => 'integer',
        'province' => 'integer',
        'regency' => 'integer',
        'district' => 'integer',
        'badge_id' => 'integer',
        'created_at' => 'datetime',
        'password' => 'hashed',
        'role' => 'string',
    ];

    public function badge()
    {
        return $this->belongsTo(Badge::class, 'badge_id');
    }

    /**
     * Filament v3: menentukan siapa yang boleh akses panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin'; // Hanya admin bisa login ke Filament
    }

    /**
     * Nama yg ditampilkan di Filament.
     */
    public function getFilamentName(): string
    {
        return $this->name ?? $this->username ?? 'Admin';
    }

    public function getUserName(): string
    {
        return (string) ($this->name ?: $this->username ?: 'Admin');
    }
}
