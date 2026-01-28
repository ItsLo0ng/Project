<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Font extends Model
{
    use CrudTrait;
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'designer',
        'description',
        'date_added',
    ];

    protected $dates = [
        'date_added',
    ];

    // ─── Relationships ──────────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(FontCategory::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(FontImage::class, 'font_id');
    }

    public function files()
    {
        return $this->hasMany(FontFile::class, 'font_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(UserFeedback::class, 'font_id');
    }

    // Optional helper: average rating
    public function averageRating(): float
    {
        return $this->feedbacks()->avg('rating') ?? 0;
    }




}