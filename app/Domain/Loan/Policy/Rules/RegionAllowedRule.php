<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy\Rules;

use App\Domain\Loan\Entities\Application;
use App\Domain\Loan\ValueObjects\RuleEffect;

final readonly class RegionAllowedRule implements Rule
{
    /**
     * @param  array<\App\Domain\Client\Enums\Region>  $regions
     */
    public function __construct(private array $regions) {}

    public function evaluate(Application $application): RuleEffect
    {
        return in_array($application->client()->region(), $this->regions)
            ? RuleEffect::allowed()
            : RuleEffect::denied('Region is not allowed list');
    }
}
