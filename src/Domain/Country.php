<?php

declare(strict_types=1);

namespace App\Domain;

use Neuron\BuildingBlocks\Domain\StringEnumTrait;

enum Country: string
{
    use StringEnumTrait;

    case PL = 'PL';
    case UA = 'UA';
}
