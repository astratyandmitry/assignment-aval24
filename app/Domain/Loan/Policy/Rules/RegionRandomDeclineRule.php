<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy\Rules;

use App\Domain\Client\Enums\Region;
use App\Domain\Loan\Entities\Application;
use App\Domain\Loan\ValueObjects\RuleEffect;

final readonly class RegionRandomDeclineRule implements Rule
{
    public function __construct(private Region $region) {}

    public function evaluate(Application $application): RuleEffect
    {
        if ($application->client()->region() !== $this->region) {
            return RuleEffect::allowed();
        }

        return random_int(0, 1) === 0
            ? RuleEffect::denied("Random region decline for {$this->region->value}")
            : RuleEffect::allowed();
    }
}
