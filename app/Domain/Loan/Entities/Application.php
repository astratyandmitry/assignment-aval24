<?php

declare(strict_types=1);

namespace App\Domain\Loan\Entities;

use App\Domain\Client\Entities\Client;

final readonly class Application
{
    public function __construct(
        private Client $client,
        private float $amount_usd,
        private int $period_days,
    ) {}

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getAmountUsd(): float
    {
        return $this->amount_usd;
    }

    public function getPeriodDays(): int
    {
        return $this->period_days;
    }
}
