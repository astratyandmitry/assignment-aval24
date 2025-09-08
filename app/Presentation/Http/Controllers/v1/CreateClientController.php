<?php

declare(strict_types=1);

namespace App\Presentation\Http\Controllers\v1;

use App\Application\DTO\CreateClientCommand;
use App\Application\UseCases\CreateClientHandler;
use App\Presentation\Http\Controllers\BaseController;
use App\Presentation\Http\Requests\v1\ClientCreateRequest;
use Illuminate\Http\JsonResponse;

final readonly class CreateClientController extends BaseController
{
    public function __construct(private CreateClientHandler $handler) {}

    public function __invoke(ClientCreateRequest $request): JsonResponse
    {
        $cmd = new CreateClientCommand(
            pin: $request->pin,
            fullName: $request->full_name,
            birthDate: $request->birth_date,
            region: $request->region,
            city: $request->city,
            phone: $request->phone,
            email: $request->email,
            creditScore: $request->credit_score,
            monthlyIncomeUsd: $request->monthly_income_usd,
        );

        $client = $this->handler->execute($cmd);

        return new JsonResponse(['data' => $client]);
    }
}
