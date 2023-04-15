<?php

declare(strict_types=1);

namespace App\Infrastructure\Configuration\Doctrine\Type;

use App\Domain\Country;

class CountryType extends AbstractEnumType
{
    public const NAME = 'country';

    public static function getEnumClass(): string
    {
        return Country::class;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
