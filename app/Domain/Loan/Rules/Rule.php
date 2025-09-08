<?php

namespace App\Domain\Loan\Rules;

use App\Domain\Loan\Decision\Decision;
use App\Domain\Loan\Entities\LoanApplication;

interface Rule
{
    public function evaluate(LoanApplication $application): Decision;
}
