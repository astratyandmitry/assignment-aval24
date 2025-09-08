<?php

declare(strict_types=1);

namespace App\Presentation\Http\Controllers\v1;

use App\Presentation\Http\Controllers\BaseController;
use App\Presentation\Http\Requests\v1\LoanIssueRequest;
use App\Presentation\Http\Resources\v1\LoanResource;

final class LoanIssueController extends BaseController
{
    public function __invoke(LoanIssueRequest $request): LoanResource {}
}
