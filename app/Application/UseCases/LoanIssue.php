<?php

declare(strict_types=1);

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
    ) {
    }

    public function execute(ApplicationDecision $applicationDecision): Loan
    {
        $decision = $applicationDecision->getDecision();
        $application = $applicationDecision->getApplication();

        if (! $decision->allowed) {
            throw new LoanPolicyException($decision->deny_reason);
        }

        $loan = new Loan(
            id: $this->idGenerator->generate(),
            client: $application->getClient(),
            name: 'Personal Credit',
            amount_usd: $application->getAmountUsd(),
            period_days: $application->getPeriodDays(),
            interest_rate: $decision->getInterestRate(),
            start_date: Carbon::today(),
            end_date: Carbon::today()->addDays($application->getPeriodDays())
        );

        return $this->repository->create($loan);
    }
}
