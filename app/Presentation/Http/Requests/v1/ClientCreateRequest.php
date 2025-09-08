<?php

declare(strict_types=1);

namespace App\Presentation\Http\Requests\v1;

use App\Presentation\Http\Requests\BaseRequest;

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
            'birth_date' => ['required', 'date'],
            'region' => ['required', 'string'],
            'city' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
            'credit_score' => ['required', 'integer'],
            'monthly_income_usd' => ['required', 'integer', 'min:1'],
        ];
    }
}
