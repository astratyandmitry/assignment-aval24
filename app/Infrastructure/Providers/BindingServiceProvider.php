<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use Override;
use App\Application\Shared\EventBus;
use App\Domain\Client\Repositories\ClientRepository;
use App\Domain\Common\Services\IdGenerator;
use App\Domain\Loan\Repositories\LoanRepository;
use App\Infrastructure\Events\LaravelEventBus;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentClientRepository;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentLoanRepository;
use App\Infrastructure\Services\UuidGenerator;
use Illuminate\Support\ServiceProvider;

final class BindingServiceProvider extends ServiceProvider
{
    #[Override]
    public function register(): void
    {
        $this->app->bind(
            IdGenerator::class,
            UuidGenerator::class,
        );

        $this->app->bind(
            ClientRepository::class,
            EloquentClientRepository::class,
        );

        $this->app->bind(
            LoanRepository::class,
            EloquentLoanRepository::class,
        );

        $this->app->bind(
            EventBus::class,
            LaravelEventBus::class,
        );
    }
}
