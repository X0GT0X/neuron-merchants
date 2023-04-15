<?php

declare(strict_types=1);

namespace App\Domain\Merchant;

interface MerchantCounterInterface
{
    public function countWithRegistrationNumber(string $registrationNumber): int;

    public function countWithTaxNumber(string $taxNumber): int;
}
