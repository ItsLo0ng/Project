<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class FontCategory extends Model
{
    use CrudTrait;
    protected $fillable = [
        'name',
        'description',
    ];

    public function fonts()
    {
        return $this->hasMany(Font::class, 'category_id');
    }
}