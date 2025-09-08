<?php

namespace App\Domain\Loan\Rules;

use App\Domain\Loan\Decision\Decision;
use App\Domain\Loan\Entities\Application;

final readonly class MinimumMonthlyIncomeRule implements Rule
{
    public function __construct(private int $min) {}

    public function evaluate(Application $application): Decision
    {
        return $application->client()->monthly_income_usd() >= $this->min
            ? Decision::allow()
            : Decision::deny("Monthly income is less than {$this->min}");
    }
}
