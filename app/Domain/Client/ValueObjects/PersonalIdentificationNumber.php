<?php

namespace App\Domain\Client\ValueObjects;

use InvalidArgumentException;
use Stringable;

final class PersonalIdentificationNumber implements Stringable
{
    public function __construct(private string $value)
    {
        if (! preg_match('/^[A-Za-z0-9\-]{6,}$/', $value)) {
            throw new InvalidArgumentException('Invalid Personal Identification Number format');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
