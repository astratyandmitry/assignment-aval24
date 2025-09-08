<?php

declare(strict_types=1);

namespace App\Presentation\Http\Requests\v1;

use App\Presentation\Http\Requests\BaseRequest;

final class LoanIssueRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'amount_usd' => ['required', 'numeric'],
            'period_days' => ['required', 'integer', 'min:30', 'max:90'],
        ];
    }
}
