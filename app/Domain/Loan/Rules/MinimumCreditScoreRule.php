<?php

namespace App\Domain\Loan\Rules;

use App\Domain\Loan\Decision\Decision;
use App\Domain\Loan\Entities\LoanApplication;

final readonly class MinimumCreditScoreRule implements Rule
{
    public function __construct(private int $min) {}

    public function evaluate(LoanApplication $application): Decision
    {
        return $application->client()->credit_score() > $this->min
            ? Decision::allow()
            : Decision::deny("Credit Score is less than {$this->min}");
    }
}
