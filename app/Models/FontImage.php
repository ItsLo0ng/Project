<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FontImage extends Model
{
    protected $fillable = [
        'font_id',
        'image_url',
        'image_type',
    ];

    public function font()
    {
        return $this->belongsTo(Font::class);
    }
}