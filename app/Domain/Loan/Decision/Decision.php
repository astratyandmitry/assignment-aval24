<?php

declare(strict_types=1);

namespace App\Domain\Loan\Decision;

use Closure;

final class Decision
{
    public ?Closure $interestRateUpdater = null;

    private ?float $interest_rate = 0;

    public function __construct(
        public readonly bool $allowed,
        public readonly ?string $deny_reason,
    ) {}

    public static function allow(): self
    {
        return new self(true, null);
    }

    public static function deny(string $reason): self
    {
        return new self(false, $reason);
    }

    public function registerInterestRateUpdater(Closure $callback): self
    {
        $this->interestRateUpdater = $callback;

        return $this;
    }

    public function setInterestRate(float $interest_rate): void
    {
        $this->interest_rate = round($interest_rate, 2);
    }

    public function getInterestRate(): float
    {
        return $this->interest_rate;
    }
}
