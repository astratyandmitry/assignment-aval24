<?php

declare(strict_types=1);

namespace App\Interface\Http\Resources;

use Illuminate\Http\Request;

final class LoanResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
