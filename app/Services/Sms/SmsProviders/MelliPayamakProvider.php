<?php

namespace App\Services\Sms\SmsProviders;

use App\Services\Sms\SmsProviderInterface;
use Illuminate\Support\Facades\Cache;

class MelliPayamakProvider implements SmsProviderInterface
{
    public function send(string $to, string $message = ''): void
    {
        info(Cache::get("otp:$to"));
        info($message);
        info($to);
    }
}
