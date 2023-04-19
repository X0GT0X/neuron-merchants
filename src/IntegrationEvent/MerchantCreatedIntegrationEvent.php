<?php

declare(strict_types=1);

namespace App\IntegrationEvent;

use App\BuildingBlocks\IntegrationEvent\IntegrationEvent;
use Symfony\Component\Uid\Uuid;

readonly class MerchantCreatedIntegrationEvent extends IntegrationEvent
{
    public const EVENT_TYPE = 'MerchantCreated';

    public function __construct(
        Uuid $id,
        \DateTimeImmutable $occurredOn,
        private Uuid $merchantId,
    ) {
        parent::__construct($id, $occurredOn);
    }

    public function getData(): array
    {
        return [
            'merchantId' => $this->merchantId,
        ];
    }

    public static function getEventType(): string
    {
        return self::EVENT_TYPE;
    }
}
