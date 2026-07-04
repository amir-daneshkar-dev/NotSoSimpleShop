<?php

namespace App\Listeners;

use App\Events\Auth\SendUserOtpEvent;
use App\Notifications\Auth\SendOtpNotification;

class SendUserOtpNotificationListener
{
    public function handle(SendUserOtpEvent $event): void
    {
        $event->user->notify(new SendOtpNotification($event->mobile));
    }
}
