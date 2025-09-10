<?php

declare(strict_types=1);

namespace App\Domain\Common\Events;

use Carbon\Carbon;
use Illuminate\Support\Str;

abstract class DomainEvent implements DomainEventContract
{
    private readonly string $eventId;

    private readonly Carbon $occurredAt;

    public function __construct(
        private readonly string $aggregateId
    ) {
        $this->eventId = Str::uuid()->toString();
        $this->occurredAt = Carbon::now();
    }

    public function eventId(): string
    {
        return $this->eventId;
    }

    public function occurredAt(): Carbon
    {
        return $this->occurredAt;
    }

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }
}
