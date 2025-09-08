<?php

declare(strict_types=1);

namespace App\Presentation\Http\Controllers\v1;

use App\Presentation\Http\Requests\v1\LoanCheckRequest;
use App\Presentation\Http\Resources\v1\LoanDecisionResource;
use Illuminate\Routing\Controller;

final class LoanCheckController extends Controller
{
    public function __invoke(LoanCheckRequest $request): LoanDecisionResource
    {
        //
    }
}
