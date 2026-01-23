<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use CrudTrait;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'subject',
        'message',
        'date_sent',
        'status',
    ];

    protected $dates = ['date_sent'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}