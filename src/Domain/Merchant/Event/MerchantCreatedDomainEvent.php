<?php

declare(strict_types=1);

namespace App\Domain\Merchant\Event;

use App\Domain\Merchant\MerchantId;
use Neuron\BuildingBlocks\Domain\DomainEventBase;
use Neuron\BuildingBlocks\Domain\DomainEventInterface;
use Symfony\Component\Uid\Uuid;

class MerchantCreatedDomainEvent extends DomainEventBase
{
    public function __construct(
        public readonly MerchantId $merchantId,
        ?Uuid $id = null,
        ?\DateTimeImmutable $occurredOn = null
    ) {
        parent::__construct($id, $occurredOn);
    }

    public static function from(Uuid $id, \DateTimeImmutable $occurredOn, array $data): DomainEventInterface
    {
        return new self(new MerchantId($data['merchantId']['value']), $id, $occurredOn);
    }
}
