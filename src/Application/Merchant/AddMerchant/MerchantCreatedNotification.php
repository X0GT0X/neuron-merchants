<?php

declare(strict_types=1);

namespace App\Application\Merchant\AddMerchant;

use App\BuildingBlocks\Application\Event\AbstractDomainEventNotification;
use App\BuildingBlocks\Application\Event\DomainEventNotification;
use App\Domain\Merchant\Event\MerchantCreatedDomainEvent;

#[DomainEventNotification(MerchantCreatedDomainEvent::class)]
readonly class MerchantCreatedNotification extends AbstractDomainEventNotification
{
}
