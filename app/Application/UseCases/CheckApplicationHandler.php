<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Application\DTO\CheckApplicationCommand;
use App\Application\DTO\CheckApplicationResult;
use App\Domain\Client\Entities\Client;
use App\Domain\Client\Exceptions\ClientNotFoundException;
use App\Domain\Client\Repositories\ClientRepository;
use App\Domain\Loan\Entities\Application;
use App\Domain\Loan\Policy\LoanEligibilityPolicy;

final readonly class CheckApplicationHandler
{
    public function __construct(
        private ClientRepository $clientRepository,
        private LoanEligibilityPolicy $policy,
    ) {}

    public function execute(CheckApplicationCommand $cmd): CheckApplicationResult
    {
        if (! ($client = $this->clientRepository->findById($cmd->clientId)) instanceof Client) {
            throw new ClientNotFoundException('Client not found by given ID');
        }

        $application = new Application(
            client: $client,
            amountUsd: $cmd->amountUsd,
            periodDays: $cmd->periodDays,
        );

        $decision = $this->policy->decide($application);

        return new CheckApplicationResult(
            clientId: $client->id(),
            allowed: $decision->allow(),
            denyReason: $decision->denyReason(),
            interestRate: $decision->interestRate()->value(),
            amountUsd: $application->amountUsd(),
            periodDays: $application->periodDays(),
        );
    }
}
