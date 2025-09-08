<?php

namespace App\Application\UseCases;

use App\Domain\Common\Services\IdGenerator;
use App\Domain\Loan\Entities\ApplicationDecision;
use App\Domain\Loan\Entities\Loan;
use App\Domain\Loan\Exceptions\LoanPolicyException;
use App\Domain\Loan\Repositories\LoanRepository;
use Carbon\Carbon;

final readonly class LoanIssue
{
    public function __construct(
        private LoanRepository $repository,
        private IdGenerator $idGenerator,
    ) {}

    public function execute(ApplicationDecision $applicationDecision): Loan
    {
        if (! $applicationDecision->decision()->allowed) {
            throw new LoanPolicyException($applicationDecision->decision()->denyReason);
        }

        $loan = new Loan(
            id: $this->idGenerator->generate(),
            client: $applicationDecision->application()->client(),
            name: 'Personal Credit',
            amountUsd: $applicationDecision->application()->amount_usd(),
            periodDays: $applicationDecision->application()->period_days(),
            interestRate: $applicationDecision->decision()->getInterestRate(),
            startDate: Carbon::today(),
            endDate: Carbon::today()->addDays($applicationDecision->application()->period_days())
        );

        return $this->repository->create($loan);
    }
}
