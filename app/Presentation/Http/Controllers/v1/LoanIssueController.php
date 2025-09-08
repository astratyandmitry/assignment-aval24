<?php

declare(strict_types=1);

namespace App\Presentation\Http\Controllers\v1;

use App\Application\UseCases\ApplicationCheck;
use App\Application\UseCases\LoanIssue;
use App\Presentation\Http\Controllers\BaseController;
use App\Presentation\Http\Requests\v1\LoanApplicationRequest;
use App\Presentation\Http\Resources\v1\LoanResource;
use Exception;
use Illuminate\Http\JsonResponse;

final class LoanIssueController extends BaseController
{
    public function __invoke(
        LoanApplicationRequest $request,
        ApplicationCheck $applicationCheck,
        LoanIssue $loanIssue,
    ): LoanResource|JsonResponse {
        try {
            $applicationDecision = $applicationCheck->execute(
                $request->dto()
            );

            $loan = $loanIssue->execute($applicationDecision);

            return new LoanResource($loan);
        } catch (Exception $e) {
            return $this->handleExceptionResponse($e);
        }
    }
}
