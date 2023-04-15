<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Merchant\Merchant;
use App\Domain\Merchant\MerchantRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MerchantRepository extends ServiceEntityRepository implements MerchantRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Merchant::class);
    }

    public function add(Merchant $merchant): void
    {
        $this->getEntityManager()->persist($merchant);
    }
}
