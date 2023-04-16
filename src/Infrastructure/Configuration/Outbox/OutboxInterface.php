<?php

declare(strict_types=1);

namespace App\Infrastructure\Configuration\Outbox;

use App\BuildingBlocks\Application\Event\DomainEventNotificationInterface;

interface OutboxInterface
{
    public function add(DomainEventNotificationInterface $notification): void;
}
