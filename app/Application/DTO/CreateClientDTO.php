<?php

namespace App\Application\DTO;

final readonly class CreateClientDTO
{
    public function __construct(
        public string $pin,
        public string $fullName,
        public string $birthDate,
        public string $region,
        public string $city,
        public string $phone,
        public string $email,
        public int $creditScore,
        public float $monthlyIncomeUsd,
    ) {}
}
