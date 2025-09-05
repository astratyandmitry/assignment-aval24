<?php

declare(strict_types=1);

namespace App\Interface\Http\Controllers;

use App\Interface\Http\Requests\ClientStoreRequest;
use App\Interface\Http\Resources\ClientResource;

final class ClientStoreController extends BaseController
{
    public function __invoke(ClientStoreRequest $request): ClientResource
    {
        //
    }
}
