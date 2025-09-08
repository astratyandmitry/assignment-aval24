<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy\Rules;

use App\Domain\Loan\Entities\Application;
use App\Domain\Loan\ValueObjects\RuleEffect;

interface Rule
{
    public function evaluate(Application $application): RuleEffect;
}
