<?php

namespace App\Dtos\Utility;

use InvalidArgumentException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

final class MobileNumber
{
    private string $e164;

    private function __construct(string $e164)
    {
        $this->e164 = $e164;
    }

    public static function fromString(string $input, ?string $country = null): self
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        $input = trim($input);

        try {
            // Parse using libphonenumber (this is the magic)
            $numberProto = $phoneUtil->parse($input, $country);

            if (! $phoneUtil->isValidNumber($numberProto)) {
                throw new InvalidArgumentException("Invalid mobile number: {$input}");
            }

            $e164 = $phoneUtil->format($numberProto, PhoneNumberFormat::E164);

            return new self($e164);

        } catch (\Throwable $e) {
            throw new InvalidArgumentException("Invalid mobile number: {$input}");
        }
    }

    public function value(): string
    {
        return $this->e164;
    }

    public function __toString(): string
    {
        return $this->e164;
    }
}
