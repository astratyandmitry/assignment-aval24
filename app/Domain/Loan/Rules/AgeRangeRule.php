<?php

namespace App\Domain\Loan\Rules;

use App\Domain\Loan\Decision\Decision;
use App\Domain\Loan\Entities\Application;

final readonly class AgeRangeRule implements Rule
{
    public function __construct(private int $min, private int $max) {}

    public function evaluate(Application $application): Decision
    {
        $age = $application->client()->birth_date()->age;

        return ($age >= $this->min && $age <= $this->max)
            ? Decision::allow()
            : Decision::deny("Age is not in a range of [{$this->min}..{$this->max}]");
    }
}
