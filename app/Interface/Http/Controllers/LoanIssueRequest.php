<?php

declare(strict_types=1);

namespace App\Interface\Http\Controllers;

use App\Interface\Http\Resources\LoanResource;

final class LoanIssueRequest extends BaseController
{
    public function __invoke(LoanIssueRequest $request): LoanResource
    {
    }
}
