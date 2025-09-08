<?php

namespace App\Domain\Client\ValueObjects;

use InvalidArgumentException;
use Stringable;

final class PhoneNumber implements Stringable
{
    public function __construct(private string $value)
    {
        $digits = preg_replace('/\D+/', '', $value);

        if (strlen($digits) < 11) {
            throw new InvalidArgumentException('Invalid Phone number format');
        }

        $this->value = '+'.ltrim($digits, '+');
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
