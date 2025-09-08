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
            'id' => $this->getId(),
            'pin' => (string) $this->getPin(),
            'full_name' => $this->getFullName(),
            'birth_date' => $this->getBirthDate()->format('Y-m-d'),
            'region' => $this->getRegion()->value,
            'city' => $this->getCity(),
            'phone' => (string) $this->getPhone(),
            'email' => (string) $this->getEmail(),
            'credit_score' => $this->getCreditScore(),
            'monthly_income_usd' => $this->getMonthlyIncomeusd(),
        ];
    }
}
