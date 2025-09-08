<?php

declare(strict_types=1);

namespace App\Presentation\Http\Resources\v1;

use App\Presentation\Http\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * @mixin \App\Domain\Client\Entities\Client
 */
final class ClientResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id(),
            'pin' => (string) $this->pin(),
            'full_name' => $this->full_name(),
            'birth_date' => $this->birth_date()->format('Y-m-d'),
            'region' => $this->region()->value,
            'city' => $this->city(),
            'phone' => (string) $this->phone(),
            'email' => (string) $this->email(),
            'credit_score' => $this->credit_score(),
            'monthly_income_usd' => $this->monthly_income_usd(),
        ];
    }
}
