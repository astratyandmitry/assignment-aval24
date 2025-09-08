<?php

declare(strict_types=1);

namespace App\Domain\Client\Entities;

use App\Domain\Client\Enums\Region;
use App\Domain\Client\ValueObjects\EmailAddress;
use App\Domain\Client\ValueObjects\PersonalIdentificationNumber;
use App\Domain\Client\ValueObjects\PhoneNumber;
use Carbon\Carbon;

final readonly class Client
{
    public function __construct(
        private string $id,
        private PersonalIdentificationNumber $pin,
        private string $fullName,
        private Carbon $birthDate,
        private Region $region,
        private string $city,
        private PhoneNumber $phone,
        private EmailAddress $email,
        private int $creditScore,
        private float $monthlyIncomeUsd,
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function fullName(): string
    {
        return $this->fullName;
    }

    public function birthDate(): Carbon
    {
        return $this->birthDate;
    }

    public function age(): int
    {
        return $this->birthDate->age;
    }

    public function region(): Region
    {
        return $this->region;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function creditScore(): int
    {
        return $this->creditScore;
    }

    public function monthlyIncomeUsd(): float
    {
        return $this->monthlyIncomeUsd;
    }

    public function pin(): PersonalIdentificationNumber
    {
        return $this->pin;
    }

    public function email(): EmailAddress
    {
        return $this->email;
    }

    public function phone(): PhoneNumber
    {
        return $this->phone;
    }
}
