<?php

declare(strict_types=1);

namespace App\Domain\Merchant;

interface MerchantRepositoryInterface
{
    public function add(Merchant $merchant): void;
}
