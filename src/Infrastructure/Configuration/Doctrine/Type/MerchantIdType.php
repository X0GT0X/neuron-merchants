<?php

declare(strict_types=1);

namespace App\Infrastructure\Configuration\Doctrine\Type;

use App\Domain\Merchant\MerchantId;

class MerchantIdType extends AbstractIdType
{
    public const NAME = 'merchant_id';

    public static function getIdClass(): string
    {
        return MerchantId::class;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
