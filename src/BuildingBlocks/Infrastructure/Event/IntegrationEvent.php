<?php

declare(strict_types=1);

namespace App\BuildingBlocks\Infrastructure\Event;

use Symfony\Component\Uid\Uuid;

readonly class IntegrationEvent
{
    public function __construct(
        private Uuid $id,
        private \DateTimeImmutable $occurredOn,
    ) {
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getOccurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
