<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy\Rules;

use App\Domain\Loan\Entities\Application;
use App\Domain\Loan\ValueObjects\RuleEffect;

final readonly class MinimumCreditScoreRule implements Rule
{
    public function __construct(private int $min) {}

    public function evaluate(Application $application): RuleEffect
    {
        return $application->client()->creditScore() > $this->min
            ? RuleEffect::allowed()
            : RuleEffect::denied("Credit Score is less than {$this->min}");
    }
}
