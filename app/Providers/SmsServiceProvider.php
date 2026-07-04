<?php

namespace App\Providers;

use App\Services\Sms\SmsChannel;
use App\Services\Sms\SmsProviderInterface;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;
use RuntimeException;

class SmsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // DI container injection
        $this->app->singleton(SmsProviderInterface::class, function ($app) {

            $providerKey = config('sms.default');

            $providerClass = config("sms.providers.$providerKey");
            if (! class_exists($providerClass)) {
                throw new RuntimeException("SMS provider class not found: {$providerClass}");
            }

            return $app->make($providerClass);
        });
    }

    public function boot(): void
    {
        // runtime features (events, notifications, macros)
        Notification::extend('sms', fn ($app) => new SmsChannel($app->make(SmsProviderInterface::class))
        );
    }
}
