<?php

namespace App\Domain\Loan\Decision;

use Closure;

final class Decision
{
    public ?Closure $interestRateUpdater = null;

    protected ?float $interestRate = 0;

    public function __construct(
        public readonly bool $allowed,
        public readonly ?string $denyReason,
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

    public function setInterestRate(float $interestRate): void
    {
        $this->interestRate = round($interestRate, 2);
    }

    public function getInterestRate(): float
    {
        return $this->interestRate;
    }
}
