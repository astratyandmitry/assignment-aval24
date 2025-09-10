<?php

declare(strict_types=1);

namespace App\Infrastructure\Events;

use App\Application\Shared\EventBus;
use App\Domain\Common\Events\DomainEvent;
use Illuminate\Events\Dispatcher;

final readonly class LaravelEventBus implements EventBus
{
    public function __construct(private Dispatcher $dispatcher)
    {
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->dispatcher->dispatch($event);
        }
    }
}
