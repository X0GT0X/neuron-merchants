<?php

namespace App\Application\Merchant\GetAllMerchants;

use App\Application\Configuration\Connection\ConnectionInterface;
use App\Application\Configuration\Connection\DTOTransformingException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetAllMerchantsQueryHandler
{
    public function __construct(private ConnectionInterface $connection)
    {
    }

    /**
     * @return MerchantDTO[]
     *
     * @throws DTOTransformingException
     * @throws \Doctrine\DBAL\Exception
     */
    public function __invoke(GetAllMerchantsQuery $query): array
    {
        $sql = '
            SELECT id, name, country, registration_number,
                   tax_number, is_active
            FROM merchants
        ';

        return $this->connection->fetchAll($sql, MerchantDTO::class);
    }
}
