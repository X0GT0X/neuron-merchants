<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Application\Contract\CommandInterface;
use App\Application\Contract\MerchantsModuleInterface;
use App\Application\Contract\QueryInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class MerchantsModule implements MerchantsModuleInterface
{
    use HandleTrait;

    public function __construct(
        private readonly MessageBusInterface $commandBus,
        private readonly MessageBusInterface $queryBus,
    ) {
    }

    public function executeCQuery(QueryInterface $query): mixed
    {
        return $this->handleQuery($query);
    }

    public function executeCommand(CommandInterface $command): mixed
    {
        return $this->handleCommand($command);
    }
}
