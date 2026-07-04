<?php

namespace App\Services\Auth;

use App\Actions\Auth\GenerateOtpAction;
use App\Dtos\Utility\MobileNumber;
use App\Events\Auth\SendUserOtpEvent;
use App\Models\User;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationService
{
    public function __construct(private GenerateOtpAction $otpGenerator) {}

    public function attemptLogin(MobileNumber $mobile)
    {
        $user = User::query()->where('mobile', $mobile)->first();

        if (! $user) {
            throw new Exception(__('auth.user.not_found'), Response::HTTP_NOT_FOUND);
        }

        $this->otpGenerator->execute($mobile->value(), 1);

        SendUserOtpEvent::dispatch($user, $mobile);
    }

    public function login()
    {
        //
    }
}

// get mobile number
// validate if it exists within db
// if yes login
// if no create user with that mobile
// ask user to complete their signup (enter name and choose password)
