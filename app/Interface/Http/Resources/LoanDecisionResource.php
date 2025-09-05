<?php

namespace App\Interface\Http\Resources;

use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class LoanDecisionResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
