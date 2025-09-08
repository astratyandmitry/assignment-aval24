<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Loan\Entities\Loan;
use App\Domain\Loan\Repositories\LoanRepository;
use App\Infrastructure\Persistence\Eloquent\Mappers\LoanMapper;

final class EloquentLoanRepository implements LoanRepository
{
    public function create(Loan $loan): Loan
    {
        LoanMapper::toModel($loan)->save();

        return $loan;
    }
}
