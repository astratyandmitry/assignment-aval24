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
        private string $full_name,
        private Carbon $birth_date,
        private Region $region,
        private string $city,
        private PhoneNumber $phone,
        private EmailAddress $email,
        private int $credit_score,
        private float $monthly_income_usd,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getFullName(): string
    {
        return $this->full_name;
    }

    public function getBirthDate(): Carbon
    {
        return $this->birth_date;
    }

    public function getAge(): int
    {
        return $this->birth_date->age;
    }

    public function getRegion(): Region
    {
        return $this->region;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCreditScore(): int
    {
        return $this->credit_score;
    }

    public function getMonthlyIncomeusd(): float
    {
        return $this->monthly_income_usd;
    }

    public function getPin(): PersonalIdentificationNumber
    {
        return $this->pin;
    }

    public function getEmail(): EmailAddress
    {
        return $this->email;
    }

    public function getPhone(): PhoneNumber
    {
        return $this->phone;
    }
}
