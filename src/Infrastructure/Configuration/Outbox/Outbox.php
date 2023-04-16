<?php

declare(strict_types=1);

namespace App\Infrastructure\Configuration\Outbox;

use App\BuildingBlocks\Application\Event\DomainEventNotificationInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;

final readonly class Outbox implements OutboxInterface
{
    public function __construct(
        private MessageBusInterface $outboxBus
    ) {
    }

    public function add(DomainEventNotificationInterface $notification): void
    {
        $this->outboxBus->dispatch($notification, [new DelayStamp(2000)]);
    }
}
