<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Application\DTO\CheckApplicationResult;
use App\Application\DTO\LoanInformation;
use App\Application\Shared\EventBus;
use App\Domain\Client\Entities\Client;
use App\Domain\Client\Exceptions\ClientNotFoundException;
use App\Domain\Client\Repositories\ClientRepository;
use App\Domain\Common\Services\IdGenerator;
use App\Domain\Loan\Entities\Loan;
use App\Domain\Loan\Events\LoanDeclined;
use App\Domain\Loan\Events\LoanIssued;
use App\Domain\Loan\Exceptions\LoanPolicyException;
use App\Domain\Loan\Repositories\LoanRepository;
use Carbon\Carbon;

final readonly class LoanIssueHandler
{
    public function __construct(
        private LoanRepository $loanRepository,
        private ClientRepository $clientRepository,
        private IdGenerator $idGenerator,
        private EventBus $eventBus,
    ) {
    }

    public function execute(CheckApplicationResult $cmd): LoanInformation
    {
        if (! ($client = $this->clientRepository->findById($cmd->clientId)) instanceof Client) {
            throw new ClientNotFoundException('Client not found by given ID');
        }

        if (! $cmd->allowed) {
            $this->dispatchDeclinedEvent($client->id(), $cmd->denyReason);

            throw new LoanPolicyException($cmd->denyReason);
        }

        $loan = new Loan(
            id: $this->idGenerator->generate(),
            client: $client,
            name: 'Personal Credit',
            amountUsd: $cmd->amountUsd,
            periodDays: $cmd->periodDays,
            interestRate: $cmd->interestRate,
            startDate: Carbon::today(),
            endDate: Carbon::today()->addDays($cmd->periodDays)
        );

        $this->loanRepository->create($loan);

        $this->dispatchIssuedEvent($client->id(), $loan->id());

        return LoanInformation::fromEntity($loan);
    }

    private function dispatchDeclinedEvent(string $clientId, string $denyReason): void
    {
        $this->eventBus->publish(
            new LoanDeclined(
                clientId: $clientId,
                denyReason: $denyReason,
            )
        );
    }

    private function dispatchIssuedEvent(string $clientId, string $loanId): void
    {
        $this->eventBus->publish(
            new LoanIssued(
                loanId: $loanId,
                clientId: $clientId,
            )
        );
    }
}
