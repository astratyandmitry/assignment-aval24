<?php

namespace App\Domain\Loan\Policy;

use App\Domain\Loan\Decision\Decision;
use App\Domain\Loan\Entities\LoanApplication;

final readonly class LoanEligibilityPolicy
{
    /**
     * @param  array<\App\Domain\Loan\Rules\Rule>  $rules
     */
    public function __construct(public float $baseInterestRate, private array $rules) {}

    public function decide(LoanApplication $application): Decision
    {
        $interestRate = $this->baseInterestRate;
        $decision = Decision::allow();

        foreach ($this->rules as $rule) {
            $decision = $rule->evaluate($application);

            if (! $decision->allowed) {
                return $decision;
            }

            if ($decision->interestRateUpdater) {
                $interestRate = ($decision->interestRateUpdater)($interestRate);
            }
        }

        $decision->setInterestRate($interestRate);

        return $decision;
    }
}
