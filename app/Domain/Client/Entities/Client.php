<?php

namespace App\Domain\Client\Entities;

use App\Domain\Client\Enums\Region;
use App\Domain\Client\ValueObjects\EmailAddress;
use App\Domain\Client\ValueObjects\PersonalIdentificationNumber;
use App\Domain\Client\ValueObjects\PhoneNumber;
use Carbon\Carbon;

final readonly class Client
{
    public function __construct(
        protected string $id,
        protected PersonalIdentificationNumber $pin,
        protected string $fullName,
        protected Carbon $birthDate,
        protected Region $region,
        protected string $city,
        protected PhoneNumber $phone,
        protected EmailAddress $email,
        protected int $creditScore,
        protected float $monthlyIncomeUsd,
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function full_name(): string
    {
        return $this->fullName;
    }

    public function birth_date(): Carbon
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

    public function credit_score(): int
    {
        return $this->creditScore;
    }

    public function monthly_income_usd(): float
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
