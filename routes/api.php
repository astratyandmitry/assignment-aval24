<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::post('clients', \App\Presentation\Http\Controllers\v1\ClientCreateController::class);
    Route::post('loans/check', \App\Presentation\Http\Controllers\v1\LoanCheckController::class);
    Route::post('loans/issue', \App\Presentation\Http\Controllers\v1\LoanIssueController::class);
});
