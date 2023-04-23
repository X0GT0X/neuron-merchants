<?php

declare(strict_types=1);

namespace App\Application\Merchant\AddMerchant;

use App\Domain\Merchant\Event\MerchantCreatedDomainEvent;
use Neuron\BuildingBlocks\Application\Event\AbstractDomainEventNotification;
use Neuron\BuildingBlocks\Application\Event\DomainEventNotification;

#[DomainEventNotification(MerchantCreatedDomainEvent::class)]
readonly class MerchantCreatedNotification extends AbstractDomainEventNotification
{
}
