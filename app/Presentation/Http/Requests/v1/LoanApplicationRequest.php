<?php

declare(strict_types=1);

namespace App\Presentation\Http\Requests\v1;

use App\Presentation\Http\Requests\BaseRequest;

/**
 * @property-read string $client_id
 * @property-read float $amount_usd
 * @property-read int $period_days
 */
final class LoanApplicationRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'client_id' => ['required', 'uuid'],
            'amount_usd' => ['required', 'numeric', 'min:1'],
            'period_days' => ['required', 'integer', 'min:1'],
        ];
    }
}
