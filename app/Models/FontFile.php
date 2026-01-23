<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FontFile extends Model
{
    protected $fillable = [
        'font_id',
        'file_url',
        'file_format',
    ];

    public function font()
    {
        return $this->belongsTo(Font::class);
    }
}