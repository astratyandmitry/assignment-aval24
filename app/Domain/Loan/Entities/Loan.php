<?php

namespace App\Domain\Loan\Entities;

use App\Domain\Client\Entities\Client;
use Carbon\Carbon;

final readonly class Loan
{
    public function __construct(
        protected string $id,
        protected Client $client,
        protected string $name,
        protected float $amountUsd,
        protected int $periodDays,
        protected float $interestRate,
        protected Carbon $startDate,
        protected Carbon $endDate,
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
