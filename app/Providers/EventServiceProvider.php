<?php

namespace App\Providers;

use App\Events\Auth\SendUserOtpEvent;
use App\Listeners\SendUserOtpNotificationListener;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SendUserOtpEvent::class => [
            SendUserOtpNotificationListener::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
