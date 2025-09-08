<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

final class BindingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Domain\Common\Services\IdGenerator::class,
            \App\Infrastructure\Services\UuidGenerator::class,
        );

        $this->app->bind(
            \App\Domain\Client\Repositories\ClientRepository::class,
            \App\Infrastructure\Persistence\Eloquent\Repositories\EloquentClientRepository::class,
        );
    }
}
