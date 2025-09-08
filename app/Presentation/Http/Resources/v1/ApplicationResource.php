<?php

declare(strict_types=1);

namespace App\Presentation\Http\Resources\v1;

use App\Presentation\Http\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * @mixin \App\Domain\Loan\Entities\ApplicationDecision
 */
final class ApplicationResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'decision' => [
                'allowed' => $this->getDecision()->allowed,
                'reason' => $this->getDecision()->deny_reason,
                'interest_rate' => $this->getDecision()->getInterestRate(),
            ],
            'application' => [
                'amount_usd' => $this->getApplication()->getAmountUsd(),
                'period_days' => $this->getApplication()->getPeriodDays(),
            ],
        ];
    }
}
