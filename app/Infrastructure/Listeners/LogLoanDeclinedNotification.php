<?php

declare(strict_types=1);

namespace App\Infrastructure\Listeners;

use App\Domain\Loan\Events\LoanDeclined;
use Illuminate\Log\Logger;

final readonly class LogLoanDeclinedNotification
{
    public function __construct(
        private Logger $logger,
    ) {
    }

    public function handle(LoanDeclined $event): void
    {
        $message = implode(' ', [
            "[{$event->occurredAt()->format('Y-m-d H:i:s')}]",
            "Client: [{$event->clientId}]",
            "loan declined",
        ]);

        $this->logger->info($message, [
            'event' => $event::eventName(),
            'event_id' => $event->eventId(),
            'occurred_at' => $event->occurredAt()->format(DATE_ATOM),
            'client_id' => $event->clientId,
        ]);
    }
}
