<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy\Rules;

use App\Domain\Loan\Entities\Application;
use App\Domain\Loan\ValueObjects\RuleEffect;

final readonly class PeriodDaysRangeRule implements Rule
{
    public function __construct(private int $min, private int $max) {}

    public function evaluate(Application $application): RuleEffect
    {
        $periodDays = $application->periodDays();

        return ($periodDays >= $this->min && $periodDays <= $this->max)
            ? RuleEffect::allowed()
            : RuleEffect::denied("Period in days is not in a range of [{$this->min}..{$this->max}]");
    }
}
