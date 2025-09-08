<?php

declare(strict_types=1);

namespace App\Domain\Loan\Rules;

use App\Domain\Loan\Decision\Decision;
use App\Domain\Loan\Entities\Application;

final readonly class RegionAllowedRule implements Rule
{
    /**
     * @param  array<\App\Domain\Client\Enums\Region>  $regions
     */
    public function __construct(private array $regions) {}

    public function evaluate(Application $application): Decision
    {
        return in_array($application->client()->region(), $this->regions)
            ? Decision::allow()
            : Decision::deny('Region is not allowed list');
    }
}
