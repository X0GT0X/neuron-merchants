<?php

declare(strict_types=1);

namespace App\Domain\Merchant\Event;

use App\BuildingBlocks\Domain\DomainEventBase;
use App\Domain\Merchant\MerchantId;

class MerchantCreatedDomainEvent extends DomainEventBase
{
    public function __construct(
        public readonly MerchantId $merchantId,
    ) {
        parent::__construct();
    }
}
