<?php

declare(strict_types=1);

namespace App\Presentation\Http\Requests\v1;

use App\Application\DTO\CreateClientDTO;
use App\Domain\Client\Enums\Region;
use App\Presentation\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

/**
 * @property-read string $pin
 * @property-read string $full_name
 * @property-read string $birth_date
 * @property-read string $region
 * @property-read string $city
 * @property-read string $phone
 * @property-read string $email
 * @property-read int $credit_score
 * @property-read float $monthly_income_usd
 */
final class ClientCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'pin' => ['required', 'string', 'max:16'],
            'full_name' => ['required', 'string'],
            'birth_date' => ['required', 'date', Rule::date()->beforeOrEqual(now()->subYears(18))],
            'region' => ['required', 'string', Rule::enum(Region::class)],
            'city' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
            'credit_score' => ['required', 'integer'],
            'monthly_income_usd' => ['required', 'integer', 'min:1'],
        ];
    }

    public function dto(): CreateClientDTO
    {
        return new CreateClientDTO(
            pin: $this->pin,
            fullName: $this->full_name,
            birthDate: $this->birth_date,
            region: $this->region,
            city: $this->city,
            phone: $this->phone,
            email: $this->email,
            creditScore: $this->credit_score,
            monthlyIncomeUsd: $this->monthly_income_usd,
        );
    }
}
