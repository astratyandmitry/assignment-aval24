<?php

namespace App\Domain\Loan\Rules;

use App\Domain\Loan\Decision\Decision;
use App\Domain\Loan\Entities\LoanApplication;

final readonly class PeriodDaysRangeRule implements Rule
{
    public function __construct(private int $min, private int $max) {}

    public function evaluate(LoanApplication $application): Decision
    {
        $periodDays = $application->period_days();

        return ($periodDays >= $this->min && $periodDays <= $this->max)
            ? Decision::allow()
            : Decision::deny("Period in days is not in a range of [{$this->min}..{$this->max}]");
    }
}
