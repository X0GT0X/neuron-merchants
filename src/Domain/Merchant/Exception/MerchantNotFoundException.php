<?php

declare(strict_types=1);

namespace App\Domain\Merchant\Exception;

use App\Domain\Exception\EntityNotFoundException;

class MerchantNotFoundException extends EntityNotFoundException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
