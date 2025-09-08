<?php

namespace App\Domain\Loan\Entities;

use App\Domain\Loan\Decision\Decision;

final readonly class LoanApplicationDecision
{
    public function __construct(
        protected LoanApplication $application,
        protected Decision $decision,
    ) {}

    public function application(): LoanApplication
    {
        return $this->application;
    }

    public function decision(): Decision
    {
        return $this->decision;
    }
}
