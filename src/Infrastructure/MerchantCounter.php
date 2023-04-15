<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Merchant\MerchantCounterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

readonly class MerchantCounter implements MerchantCounterInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function countWithRegistrationNumber(string $registrationNumber): int
    {
        $query = $this->entityManager->createQuery('SELECT count(m) FROM App\Domain\Merchant\Merchant m WHERE m.registrationNumber = :registrationNumber')
            ->setParameter('registrationNumber', $registrationNumber);

        return (int) ($query->getSingleScalarResult());
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function countWithTaxNumber(string $taxNumber): int
    {
        $query = $this->entityManager->createQuery('SELECT count(m) FROM App\Domain\Merchant\Merchant m WHERE m.taxNumber = :taxNumber')
            ->setParameter('taxNumber', $taxNumber);

        return (int) ($query->getSingleScalarResult());
    }
}
