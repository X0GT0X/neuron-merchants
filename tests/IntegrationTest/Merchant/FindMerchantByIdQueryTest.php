<?php

declare(strict_types=1);

namespace App\Tests\IntegrationTest\Merchant;

use App\Application\Merchant\AddMerchant\AddMerchantCommand;
use App\Application\Merchant\FindMerchantById\FindMerchantByIdQuery;
use App\Application\Merchant\FindMerchantById\MerchantDTO;
use App\Domain\Country;
use App\Domain\Merchant\Exception\MerchantNotFoundException;
use App\Tests\IntegrationTest\IntegrationTestCase;
use Symfony\Component\Uid\Uuid;

class FindMerchantByIdQueryTest extends IntegrationTestCase
{
    public function testFindMerchantByIdQuery(): void
    {
        $merchantId = $this->merchantsModule->executeCommand(new AddMerchantCommand(
            'Name',
            Country::PL,
            'registrationNumber',
            'PL1234567890'
        ));

        $merchant = $this->merchantsModule->executeQuery(new FindMerchantByIdQuery($merchantId));

        $this->assertInstanceOf(MerchantDTO::class, $merchant);
        $this->assertEquals((string) $merchantId, $merchant->id);
        $this->assertEquals('Name', $merchant->name);
        $this->assertEquals(Country::PL->value, $merchant->country);
        $this->assertEquals('registrationNumber', $merchant->registrationNumber);
        $this->assertEquals('PL1234567890', $merchant->taxNumber);
        $this->assertTrue($merchant->isActive);
    }

    public function testThatThrowsNotFoundExceptionIfMerchantNotFound(): void
    {
        $this->expectException(MerchantNotFoundException::class);
        $this->expectExceptionMessage('Merchant with id \'ec6e6c27-06f7-4741-a4ff-137d1d02ed9c\' not found');

        $this->merchantsModule->executeQuery(new FindMerchantByIdQuery(Uuid::fromString('ec6e6c27-06f7-4741-a4ff-137d1d02ed9c')));
    }
}
