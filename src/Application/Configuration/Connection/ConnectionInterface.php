<?php

declare(strict_types=1);

namespace App\Application\Configuration\Connection;

use Doctrine\DBAL\Exception;

interface ConnectionInterface
{
    /**
     * @template T
     *
     * @param array<string, mixed> $parameters
     * @param class-string<T>      $dtoClass
     *
     * @throws DTOTransformingException|Exception
     * @throws NotFoundException
     *
     * @return T
     */
    public function fetchOne(string $sql, string $dtoClass, array $parameters = []);

    /**
     * @template T
     *
     * @param array<string, mixed> $parameters
     * @param class-string<T>      $dtoClass
     *
     * @throws DTOTransformingException|Exception
     *
     * @return array<T>
     */
    public function fetchAll(string $sql, string $dtoClass, array $parameters = []): array;
}
