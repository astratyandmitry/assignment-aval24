<?php

declare(strict_types=1);

namespace App\Presentation\Http\Controllers\v1;

use App\Application\UseCases\CreateClient;
use App\Presentation\Http\Controllers\BaseController;
use App\Presentation\Http\Requests\v1\ClientCreateRequest;
use App\Presentation\Http\Resources\v1\ClientResource;
use Exception;
use Illuminate\Http\JsonResponse;

final class ClientCreateController extends BaseController
{
    public function __invoke(
        ClientCreateRequest $request,
        CreateClient $useCase,
    ): ClientResource|JsonResponse {
        try {
            $client = $useCase->execute(
                $request->dto()
            );

            return new ClientResource($client);
        } catch (Exception $e) {
            return $this->handle_exception($e);
        }
    }
}
