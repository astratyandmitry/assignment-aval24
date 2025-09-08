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
            'id' => $this->id(),
            'name' => $this->name(),
            'amount_usd' => $this->amount_usd(),
            'interest_rate' => $this->interest_rate(),
            'period_days' => $this->period_days(),
            'period' => [
                'start' => $this->start_date()->format('Y-m-d'),
                'end' => $this->end_date()->format('Y-m-d'),
            ],
            'client' => new ClientResource($this->client()),
        ];
    }
}
