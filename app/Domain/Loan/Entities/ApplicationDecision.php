<?php

namespace App\Domain\Loan\Entities;

use App\Domain\Loan\Decision\Decision;

final readonly class ApplicationDecision
{
    public function __construct(
        protected Application $application,
        protected Decision $decision,
    ) {}

    public function application(): Application
    {
        return $this->application;
    }

    public function decision(): Decision
    {
        return $this->decision;
    }
}
