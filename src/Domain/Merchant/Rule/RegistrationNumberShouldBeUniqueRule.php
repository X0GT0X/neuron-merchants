<?php

declare(strict_types=1);

namespace App\Domain\Merchant\Rule;

use App\BuildingBlocks\Domain\AbstractBusinessRule;
use App\Domain\Merchant\MerchantCounterInterface;

class RegistrationNumberShouldBeUniqueRule extends AbstractBusinessRule
{
    public function __construct(
        private readonly string $registrationNumber,
        private readonly MerchantCounterInterface $merchantCounter,
    ) {
    }

    public function isBroken(): bool
    {
        return $this->merchantCounter->countWithRegistrationNumber($this->registrationNumber) > 0;
    }

    public function getMessageTemplate(): string
    {
        return 'Merchant with registration number \'%s\' already exists';
    }

    public function getMessageArguments(): array
    {
        return [$this->registrationNumber];
    }
}
