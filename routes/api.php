<?php

declare(strict_types=1);

use App\Presentation\Http\Controllers\v1\ClientCreateController;
use App\Presentation\Http\Controllers\v1\ApplicationCheckController;
use App\Presentation\Http\Controllers\v1\LoanIssueController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::post('clients', ClientCreateController::class);
    Route::post('applications', ApplicationCheckController::class);
    Route::post('loans', LoanIssueController::class);
});
