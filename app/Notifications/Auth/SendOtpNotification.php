<?php

namespace App\Notifications\Auth;

use App\Dtos\Utility\MobileNumber;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SendOtpNotification extends Notification
{
    use Queueable;

    public function __construct(public MobileNumber $mobile) {}

    public function via(object $notifiable): array
    {
        return ['sms'];
    }

    public function toSms($notifiable)
    {
        return "Your OTP has been sent to {$this->mobile->value()}";
    }
}
