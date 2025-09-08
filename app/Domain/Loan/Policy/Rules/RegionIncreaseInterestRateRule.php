<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy\Rules;

use App\Domain\Client\Enums\Region;
use App\Domain\Loan\Entities\Application;
use App\Domain\Loan\ValueObjects\RuleEffect;

final readonly class RegionIncreaseInterestRateRule implements Rule
{
    public function __construct(private Region $region, private float $increasePercentage) {}

    public function evaluate(Application $application): RuleEffect
    {
        if ($application->client()->region() === $this->region) {
            return RuleEffect::allowedWithRateDelta($this->increasePercentage);
        }

        return RuleEffect::allowed();
    }
}
