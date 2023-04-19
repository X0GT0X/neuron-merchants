<?php

declare(strict_types=1);

namespace App\BuildingBlocks\IntegrationEvent;

use Symfony\Component\Uid\Uuid;

readonly abstract class IntegrationEvent
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

    /**
     * @return array<string, mixed>
     */
    public abstract function getData(): array;

    public static abstract function getEventType(): string;

    /**
     * @return array<string, mixed>
     */
    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'occurredOn' => $this->occurredOn,
            'data' => $this->getData(),
        ];
    }
}
