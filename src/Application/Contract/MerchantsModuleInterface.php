<?php

declare(strict_types=1);

namespace App\Application\Contract;

interface MerchantsModuleInterface
{
    public function executeQuery(QueryInterface $query): mixed;

    public function executeCommand(CommandInterface $command): mixed;
}
