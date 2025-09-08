<?php

declare(strict_types=1);

namespace App\Domain\Loan\Repositories;

use App\Domain\Loan\Entities\Loan;

interface LoanRepository
{
    public function create(Loan $loan): Loan;
}
