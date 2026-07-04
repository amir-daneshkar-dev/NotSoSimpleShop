<?php

namespace App\Services\Sms;

class SmsChannel
{
    public function __construct(
        private SmsProviderInterface $provider
    ) {}

    public function send($notifiable, $notification)
    {
        if (! method_exists($notification, 'toSms')) {
            return;
        }

        $message = $notification->toSms($notifiable);

        $this->provider->send(
            $notifiable->mobile,
            $message
        );
    }
}
