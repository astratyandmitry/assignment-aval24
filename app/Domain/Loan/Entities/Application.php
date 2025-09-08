<?php

declare(strict_types=1);

namespace App\Domain\Loan\Entities;

use App\Domain\Client\Entities\Client;

final readonly class Application
{
    public function __construct(
        private Client $client,
        private float $amountUsd,
        private int $periodDays,
    ) {}

    public function client(): Client
    {
        return $this->client;
    }

    public function amountUsd(): float
    {
        return $this->amountUsd;
    }

    public function periodDays(): int
    {
        return $this->periodDays;
    }
}
