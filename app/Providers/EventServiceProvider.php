<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\UserRegistered;
use App\Listeners\CreateUserFolder;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Application's Events and Listeners.
     * 
     * @var array
     */
    protected $listen = [
        UserRegistered::class => [
            CreateUserFolder::class,
        ],
    ];

    /**
     * Bootstrap services.
     * 
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }
}
