<?php

namespace App\Domain\Loan\Rules;

use App\Domain\Loan\Decision\Decision;
use App\Domain\Loan\Entities\LoanApplication;

final readonly class RegionAllowedRule implements Rule
{
    /**
     * @param  array<\App\Domain\Client\Enums\Region>  $regions
     */
    public function __construct(private array $regions) {}

    public function evaluate(LoanApplication $application): Decision
    {
        return in_array($application->client()->region(), $this->regions)
            ? Decision::allow()
            : Decision::deny('Region is not allowed list');
    }
}
