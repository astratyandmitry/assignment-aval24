<?php

namespace App\Application\UseCases;

use App\Application\DTO\ApplicationCheckDTO;
use App\Domain\Client\Exceptions\ClientNotFoundException;
use App\Domain\Client\Repositories\ClientRepository;
use App\Domain\Loan\Entities\LoanApplication;
use App\Domain\Loan\Entities\LoanApplicationDecision;
use App\Domain\Loan\Policy\LoanEligibilityPolicy;

final readonly class ApplicationCheck
{
    public function __construct(
        private ClientRepository $clientRepository,
        private LoanEligibilityPolicy $policy,
    ) {}

    public function execute(ApplicationCheckDTO $dto): LoanApplicationDecision
    {
        if (! $client = $this->clientRepository->findById($dto->clientId)) {
            throw new ClientNotFoundException('Client not found by given ID');
        }

        $application = new LoanApplication(
            client: $client,
            amountUsd: $dto->amountUsd,
            periodDays: $dto->periodDays,
        );

        $decision = $this->policy->decide($application);

        return new LoanApplicationDecision(
            application: $application,
            decision: $decision,
        );
    }
}
