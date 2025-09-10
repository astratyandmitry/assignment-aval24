<?php

declare(strict_types=1);

namespace App\Domain\Common\Events;

use Carbon\Carbon;

interface DomainEventContract
{
    public function eventId(): string;

    public function occurredAt(): Carbon;

    public function aggregateId(): string;

    public static function eventName(): string;
}
