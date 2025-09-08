<?php

declare(strict_types=1);

use App\Presentation\Http\Controllers\v1\CheckApplicationController;
use App\Presentation\Http\Controllers\v1\CreateClientController;
use App\Presentation\Http\Controllers\v1\LoanIssueController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::post('clients', CreateClientController::class);
    Route::post('loans/application', CheckApplicationController::class);
    Route::post('loans/issue', LoanIssueController::class);
});
