<?php

namespace App\Providers;

use App\Models\Font;
use App\Policies\FontPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Font::class => FontPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
