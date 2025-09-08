<?php

declare(strict_types=1);

namespace App\Presentation\Http\Controllers\v1;

use App\Application\UseCases\ApplicationCheck;
use App\Presentation\Http\Controllers\BaseController;
use App\Presentation\Http\Requests\v1\LoanApplicationRequest;
use App\Presentation\Http\Resources\v1\ApplicationResource;
use Exception;
use Illuminate\Http\JsonResponse;

final class ApplicationCheckController extends BaseController
{
    public function __invoke(
        LoanApplicationRequest $request,
        ApplicationCheck $applicationCheck,
    ): ApplicationResource|JsonResponse {
        try {
            $decision = $applicationCheck->execute(
                $request->dto()
            );

            return new ApplicationResource($decision);
        } catch (Exception $e) {
            return $this->handleExceptionResponse($e);
        }
    }
}
