<?php

declare(strict_types=1);

namespace App\Domain\Loan\Entities;

use App\Domain\Loan\Decision\Decision;

final readonly class ApplicationDecision
{
    public function __construct(
        private Application $application,
        private Decision $decision,
    ) {}

    public function getApplication(): Application
    {
        return $this->application;
    }

    public function getDecision(): Decision
    {
        return $this->decision;
    }
}
