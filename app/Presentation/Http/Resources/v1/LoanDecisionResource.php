<?php

declare(strict_types=1);

namespace App\Presentation\Http\Resources\v1;

use App\Presentation\Http\Resources\BaseResource;
use Illuminate\Http\Request;

final class LoanDecisionResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
