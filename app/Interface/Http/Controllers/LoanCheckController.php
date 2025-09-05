<?php

namespace App\Interface\Http\Controllers;

use App\Interface\Http\Requests\LoanCheckRequest;
use App\Interface\Http\Resources\LoanDecisionResource;
use Illuminate\Routing\Controller;

final class LoanCheckController extends Controller
{
    public function __invoke(LoanCheckRequest $request): LoanDecisionResource
    {
        //
    }
}
