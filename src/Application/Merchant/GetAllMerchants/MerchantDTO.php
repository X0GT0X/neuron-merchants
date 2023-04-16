<?php

declare(strict_types=1);

namespace App\Application\Merchant\GetAllMerchants;

final readonly class MerchantDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $country,
        public string $registrationNumber,
        public string $taxNumber,
        public bool $isActive,
    ) {
    }
}
