<?php

declare(strict_types=1);

namespace App\Presentation\Http\Controllers\v1;

use App\Application\UseCases\ApplicationCheck;
use App\Presentation\Http\Controllers\BaseController;
use App\Presentation\Http\Requests\v1\ApplicationCheckRequest;
use App\Presentation\Http\Resources\v1\ApplicationResource;
use Exception;
use Illuminate\Http\JsonResponse;

final class ApplicationCheckController extends BaseController
{
    public function __invoke(
        ApplicationCheckRequest $request,
        ApplicationCheck $useCase,
    ): ApplicationResource|JsonResponse {
        try {
            $decision = $useCase->execute(
                $request->dto()
            );

            return new ApplicationResource($decision);
        } catch (Exception $e) {
            return $this->handle_exception($e);
        }
    }
}
