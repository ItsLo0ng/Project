<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class UserFeedback extends Model
{
    use CrudTrait;
    protected $fillable = [
        'user_id',
        'font_id',
        'rating',
        'comment',
        'feedback_date',
    ];

    protected $dates = ['feedback_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function font()
    {
        return $this->belongsTo(Font::class);
    }
}