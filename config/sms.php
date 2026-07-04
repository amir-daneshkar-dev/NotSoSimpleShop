<?php

use App\Services\Sms\SmsProviders\MelliPayamakProvider;

return [

    'default' => env('SMS_PROVIDER', 'Melli'),

    'providers' => [
        'Melli' => MelliPayamakProvider::class,
    ],

];
