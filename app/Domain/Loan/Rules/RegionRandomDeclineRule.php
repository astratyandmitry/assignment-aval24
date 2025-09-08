<?php

namespace App\Domain\Loan\Rules;

use App\Domain\Client\Enums\Region;
use App\Domain\Loan\Decision\Decision;
use App\Domain\Loan\Entities\LoanApplication;

final readonly class RegionRandomDeclineRule implements Rule
{
    public function __construct(private Region $region) {}

    public function evaluate(LoanApplication $application): Decision
    {
        if ($application->client()->region() !== $this->region) {
            return Decision::allow();
        }

        return rand(0, 1) === 0
            ? Decision::deny("Random region decline for {$this->region->value}")
            : Decision::allow();
    }
}
