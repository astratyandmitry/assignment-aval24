<?php

namespace App\Interface\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class ClientResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
