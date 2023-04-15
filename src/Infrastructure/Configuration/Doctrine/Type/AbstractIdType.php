<?php

declare(strict_types=1);

namespace App\Infrastructure\Configuration\Doctrine\Type;

use App\BuildingBlocks\Domain\BaseId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Symfony\Component\Uid\Uuid;

abstract class AbstractIdType extends GuidType
{
    abstract public static function getIdClass(): string;

    /**
     * @param BaseId $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): Uuid
    {
        return $value->getValue();
    }

    /**
     * @param string $value
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): BaseId
    {
        return new ($this::getIdClass())(Uuid::fromString($value));
    }
}
