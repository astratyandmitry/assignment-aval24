<?php

declare(strict_types=1);

namespace App\Domain\Loan\Rules;

use App\Domain\Client\Enums\Region;
use App\Domain\Loan\Decision\Decision;
use App\Domain\Loan\Entities\Application;

final readonly class RegionIncreaseInterestRateRule implements Rule
{
    public function __construct(private Region $region, private float $increasePercentage) {}

    public function evaluate(Application $application): Decision
    {
        if ($application->client()->region() === $this->region) {
            return Decision::allow()
                ->registerInterestRateUpdater(fn (float $rate): float => $rate + $this->increasePercentage);
        }

        return Decision::allow();
    }
}
