<?php

namespace App\Domain\Loan\Repositories;

use App\Domain\Loan\Entities\Loan;

interface LoanRepository
{
    public function create(Loan $loan): Loan;
}
