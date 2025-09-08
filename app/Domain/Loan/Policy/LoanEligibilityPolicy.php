<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy;

use App\Domain\Loan\Entities\Application;
use App\Domain\Loan\ValueObjects\Decision;
use App\Domain\Loan\ValueObjects\InterestRate;

final readonly class LoanEligibilityPolicy
{
    /**
     * @param  array<\App\Domain\Loan\Policy\Rules\Rule>  $rules
     */
    public function __construct(
        public InterestRate $baseInterestRate,
        private array $rules,
    ) {}

    public function decide(Application $application): Decision
    {
        $rate = $this->baseInterestRate;

        foreach ($this->rules as $rule) {
            $effect = $rule->evaluate($application);

            if ($effect->isDenied()) {
                return Decision::denied($effect->denyReason());
            }

            if ($effect->rateDelta()) {
                $rate = $rate->applyDelta($effect->rateDelta());
            }
        }

        return Decision::allowed($rate);
    }
}
