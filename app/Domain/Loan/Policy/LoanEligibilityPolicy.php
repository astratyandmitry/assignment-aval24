<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy;

use App\Domain\Loan\Decision\Decision;
use App\Domain\Loan\Entities\Application;

final readonly class LoanEligibilityPolicy
{
    /**
     * @param  array<\App\Domain\Loan\Rules\Rule>  $rules
     */
    public function __construct(public float $base_interest_rate, private array $rules) {}

    public function decide(Application $application): Decision
    {
        $interestRate = $this->base_interest_rate;
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
