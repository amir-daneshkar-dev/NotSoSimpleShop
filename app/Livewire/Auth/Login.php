<?php

namespace App\Livewire\Auth;

use App\Dtos\Utility\MobileNumber;
use App\Services\Auth\AuthenticationService;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Login extends Component
{
    public string $mobile = '';

    public string $code = '';

    public bool $remember = false;

    public int $step = 1;

    public int $expiresIn = 60;

    public bool $otpSent = false;

    public function sendOtp(AuthenticationService $authService)
    {
        $this->validate([
            'mobile' => ['required', 'string'],
        ]);

        $mobile = MobileNumber::fromString($this->mobile, 'IR');

        $authService->attemptLogin($mobile);

        $this->step = 2;
        $this->otpSent = true;
        $this->expiresIn = 60;

        $this->dispatch('start-timer');
    }

    public function login()
    {
        $this->validate([
            'mobile' => ['required', 'string'],
            'code' => ['required', 'string'],
        ]);

        $mobile = MobileNumber::fromString($this->mobile, 'IR');

        $cached = Cache::get($this->otpKey($mobile));

        if (! $cached || $cached !== $this->code) {
            $this->addError('code', 'Invalid or expired code.');

            return;
        }

        Cache::forget($this->otpKey($mobile));

        // TODO: authenticate user here

        return redirect()->intended('/');
    }

    private function otpKey(MobileNumber $mobile): string
    {
        return 'otp:'.$mobile->value();
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.public_layout');
    }
}
