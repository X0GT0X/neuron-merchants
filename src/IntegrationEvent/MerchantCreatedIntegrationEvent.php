<?php

namespace App\IntegrationEvent;

use App\BuildingBlocks\Infrastructure\Event\IntegrationEvent;
use Symfony\Component\Uid\Uuid;

readonly class MerchantCreatedIntegrationEvent extends IntegrationEvent
{
    public function __construct(
        Uuid $id,
        \DateTimeImmutable $occurredOn,
        private Uuid $merchantId,
    ) {
        parent::__construct($id, $occurredOn);
    }

    public function __serialize(): array
    {
        return [
            'id' => $this->getId(),
            'occurredOn' => $this->getOccurredOn(),
            'merchantId' => $this->merchantId,
        ];
    }
}
