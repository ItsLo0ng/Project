<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;   // ← uncomment if you plan to use API later

class User extends Authenticatable
{
    use CrudTrait;
    use Notifiable;
    // use HasApiTokens;   // ← if using Sanctum

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // ─── Relationships ──────────────────────────────────────────────

    public function fonts()
    {
        return $this->hasMany(Font::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(UserFeedback::class);
    }

    // Optional: helper method
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}