<?php

declare(strict_types=1);

namespace App\Application\DTO;

final readonly class ApplicationCheckDTO
{
    public function __construct(
        public string $clientId,
        public float $amountUsd,
        public int $periodDays,
    ) {}
}
