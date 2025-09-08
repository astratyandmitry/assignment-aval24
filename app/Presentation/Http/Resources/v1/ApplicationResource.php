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
                'allowed' => $this->decision()->allowed,
                'reason' => $this->decision()->denyReason,
                'interest_rate' => $this->decision()->getInterestRate(),
            ],
            'application' => [
                'amount_usd' => $this->application()->amount_usd(),
                'period_days' => $this->application()->period_days(),
            ],
        ];
    }
}
