<?php

declare(strict_types=1);

namespace App\Application\Merchant\FindMerchantById;

use App\Application\Configuration\Connection\ConnectionInterface;
use App\Application\Configuration\Connection\DTOTransformingException;
use App\Application\Configuration\Connection\NotFoundException;
use App\Application\Contract\AbstractCommand;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FindMerchantByIdQueryHandler extends AbstractCommand
{
    public function __construct(
        private readonly ConnectionInterface $connection
    ) {
        parent::__construct();
    }

    /**
     * @throws DTOTransformingException
     * @throws \Doctrine\DBAL\Exception
     * @throws NotFoundException
     */
    public function __invoke(FindMerchantByIdQuery $query): MerchantDTO
    {
        $sql = '
            SELECT id, name, country, registration_number,
                   tax_number, is_active
            FROM merchants m
            WHERE m.id = :id
        ';

        return $this->connection->fetchOne($sql, MerchantDTO::class, ['id' => $query->merchantId]);
    }
}
