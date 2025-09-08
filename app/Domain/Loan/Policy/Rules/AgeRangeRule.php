<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy\Rules;

use App\Domain\Loan\Entities\Application;
use App\Domain\Loan\ValueObjects\RuleEffect;

final readonly class AgeRangeRule implements Rule
{
    public function __construct(private int $min, private int $max) {}

    public function evaluate(Application $application): RuleEffect
    {
        $age = $application->client()->birthDate()->age;

        return ($age >= $this->min && $age <= $this->max)
            ? RuleEffect::allowed()
            : RuleEffect::denied("Age is not in a range of [{$this->min}..{$this->max}]");
    }
}
