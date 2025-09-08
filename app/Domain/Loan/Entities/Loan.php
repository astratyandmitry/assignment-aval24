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
        private float $amount_usd,
        private int $period_days,
        private float $interest_rate,
        private Carbon $start_date,
        private Carbon $end_date,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmountUsd(): float
    {
        return $this->amount_usd;
    }

    public function getPeriodDays(): int
    {
        return $this->period_days;
    }

    public function getInterestRate(): float
    {
        return $this->interest_rate;
    }

    public function getStartDate(): Carbon
    {
        return $this->start_date;
    }

    public function getEndDate(): Carbon
    {
        return $this->end_date;
    }
}
