<?php

declare(strict_types=1);

namespace App\Presentation\Http\Controllers\v1;

use App\Application\DTO\CheckApplicationCommand;
use App\Application\UseCases\CheckApplicationHandler;
use App\Presentation\Http\Controllers\BaseController;
use App\Presentation\Http\Requests\v1\LoanApplicationRequest;
use Illuminate\Http\JsonResponse;

final readonly class CheckApplicationController extends BaseController
{
    public function __construct(private CheckApplicationHandler $handler) {}

    public function __invoke(LoanApplicationRequest $request): JsonResponse
    {
        $cmd = new CheckApplicationCommand(
            clientId: $request->client_id,
            amountUsd: $request->amount_usd,
            periodDays: $request->period_days,
        );

        $loanApplicationResult = $this->handler->execute($cmd);

        return new JsonResponse(['data' => $loanApplicationResult]);
    }
}
