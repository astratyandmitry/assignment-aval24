<?php

namespace App\Domain\Loan\Rules;

use App\Domain\Loan\Decision\Decision;
use App\Domain\Loan\Entities\Application;

interface Rule
{
    public function evaluate(Application $application): Decision;
}
