<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Cache;

final class GenerateOtpAction
{
    /**
     * Generate and cache a 5-digit OTP.
     *
     * @param  string  $key  Unique identifier (e.g. mobile number)
     */
    public function execute(string $key, int $ttlMinutes = 2): string
    {
        $otp = (string) random_int(10000, 99999);

        Cache::put(
            $this->cacheKey($key),
            $otp,
            now()->addMinutes($ttlMinutes)
        );

        return $otp;
    }

    private function cacheKey(string $key): string
    {
        return "otp:{$key}";
    }
}
