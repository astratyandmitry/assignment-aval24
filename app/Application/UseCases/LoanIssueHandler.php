<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Application\DTO\CheckApplicationResult;
use App\Application\DTO\LoanInformation;
use App\Domain\Client\Entities\Client;
use App\Domain\Client\Exceptions\ClientNotFoundException;
use App\Domain\Client\Repositories\ClientRepository;
use App\Domain\Common\Services\IdGenerator;
use App\Domain\Loan\Entities\Loan;
use App\Domain\Loan\Exceptions\LoanPolicyException;
use App\Domain\Loan\Repositories\LoanRepository;
use Carbon\Carbon;

final readonly class LoanIssueHandler
{
    public function __construct(
        private LoanRepository $loanRepository,
        private ClientRepository $clientRepository,
        private IdGenerator $idGenerator,
    ) {}

    public function execute(CheckApplicationResult $cmd): LoanInformation
    {
        if (! ($client = $this->clientRepository->findById($cmd->clientId)) instanceof Client) {
            throw new ClientNotFoundException('Client not found by given ID');
        }

        if (! $cmd->allowed) {
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

        return LoanInformation::fromEntity($loan);
    }
}
