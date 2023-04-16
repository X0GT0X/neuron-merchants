<?php

declare(strict_types=1);

namespace App\Application\Merchant\GetAllMerchants;

use App\Application\Configuration\Connection\ConnectionInterface;
use App\Application\Configuration\Connection\DTOTransformingException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetAllMerchantsQueryHandler
{
    public function __construct(
        private ConnectionInterface $connection
    ) {
    }

    /**
     * @throws DTOTransformingException
     * @throws \Doctrine\DBAL\Exception
     *
     * @return MerchantDTO[]
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
