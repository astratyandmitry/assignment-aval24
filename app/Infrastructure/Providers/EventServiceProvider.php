<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Domain\Loan\Events\LoanDeclined;
use App\Domain\Loan\Events\LoanIssued;
use App\Infrastructure\Listeners\LogLoanDeclinedNotification;
use App\Infrastructure\Listeners\LogLoanIssuedNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

final class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        LoanIssued::class => [LogLoanIssuedNotification::class],
        LoanDeclined::class => [LogLoanDeclinedNotification::class],
    ];
}
