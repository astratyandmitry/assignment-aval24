<?php

declare(strict_types=1);

namespace App\Presentation\Http\Resources\v1;

use App\Presentation\Http\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * @mixin \App\Domain\Loan\Entities\Loan
 */
final class LoanResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'amount_usd' => $this->getAmountUsd(),
            'interest_rate' => $this->getInterestRate(),
            'period_days' => $this->getPeriodDays(),
            'period' => [
                'start' => $this->getStartDate()->format('Y-m-d'),
                'end' => $this->getEndDate()->format('Y-m-d'),
            ],
            'client' => new ClientResource($this->getClient()),
        ];
    }
}
