<?php

declare(strict_types=1);

namespace App\Application\Merchant\FindMerchantById;

use App\Application\Contract\QueryInterface;
use Symfony\Component\Uid\Uuid;

final readonly class FindMerchantByIdQuery implements QueryInterface
{
    public function __construct(
        public Uuid $merchantId
    ) {
    }
}
