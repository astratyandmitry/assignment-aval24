<?php

declare(strict_types=1);

namespace App\Domain\Loan\Entities;

use App\Domain\Client\Entities\Client;
use Carbon\Carbon;

final readonly class Loan
{
    public function __construct(
        private string $id,
        private Client $client,
        private string $name,
        private float $amountUsd,
        private int $periodDays,
        private float $interestRate,
        private Carbon $startDate,
        private Carbon $endDate,
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function client(): Client
    {
        return $this->client;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function amount_usd(): float
    {
        return $this->amountUsd;
    }

    public function period_days(): int
    {
        return $this->periodDays;
    }

    public function interest_rate(): float
    {
        return $this->interestRate;
    }

    public function start_date(): Carbon
    {
        return $this->startDate;
    }

    public function end_date(): Carbon
    {
        return $this->endDate;
    }
}
