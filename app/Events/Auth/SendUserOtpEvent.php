<?php

namespace App\Events\Auth;

use App\Dtos\Utility\MobileNumber;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendUserOtpEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public User $user, public MobileNumber $mobile) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('auth.login'),
        ];
    }
}
