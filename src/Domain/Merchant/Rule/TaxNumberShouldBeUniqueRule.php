<?php

declare(strict_types=1);

namespace App\Domain\Merchant\Rule;

use App\BuildingBlocks\Domain\AbstractBusinessRule;
use App\Domain\Merchant\MerchantCounterInterface;

class TaxNumberShouldBeUniqueRule extends AbstractBusinessRule
{
    public function __construct(
        private readonly string $taxNumber,
        private readonly MerchantCounterInterface $merchantCounter,
    ) {
    }

    public function isBroken(): bool
    {
        return $this->merchantCounter->countWithTaxNumber($this->taxNumber) > 0;
    }

    public function getMessageTemplate(): string
    {
        return 'Merchant with tax number \'%s\' already exists';
    }

    public function getMessageArguments(): array
    {
        return [$this->taxNumber];
    }
}
