<?php

declare(strict_types=1);

namespace App\Tests\IntegrationTest\Merchant;

use App\Application\Configuration\Command\InvalidCommandException;
use App\Application\Merchant\AddMerchant\AddMerchantCommand;
use App\Application\Merchant\FindMerchantById\FindMerchantByIdQuery;
use App\Application\Merchant\FindMerchantById\MerchantDTO;
use App\Domain\Country;
use App\Tests\IntegrationTest\IntegrationTestCase;

class AddMerchantCommandTest extends IntegrationTestCase
{
    public function testAddMerchantCommand(): void
    {
        $merchantId = $this->merchantsModule->executeCommand(new AddMerchantCommand(
            'Name',
            Country::PL,
            'registrationNumber',
            'PL1234567890'
        ));

        /** @var MerchantDTO $merchant */
        $merchant = $this->merchantsModule->executeQuery(new FindMerchantByIdQuery($merchantId));

        $this->assertEquals((string) $merchantId, $merchant->id);
        $this->assertEquals('Name', $merchant->name);
        $this->assertEquals(Country::PL->value, $merchant->country);
        $this->assertEquals('registrationNumber', $merchant->registrationNumber);
        $this->assertEquals('PL1234567890', $merchant->taxNumber);
        $this->assertTrue($merchant->isActive);
    }

    public function testThatThrowsInvalidCommandExceptionIfRegistrationNumberDoesNotMatchRegex(): void
    {
        $this->expectException(InvalidCommandException::class);
        $this->expectExceptionMessage('Invalid command exception');

        $this->merchantsModule->executeCommand(new AddMerchantCommand(
            'Name',
            Country::PL,
            '!registration#Number@',
            'PL1234567890'
        ));
    }

    public function testThatThrowsInvalidCommandExceptionIfTaxNumberDoesNotMatchRegex(): void
    {
        $this->expectException(InvalidCommandException::class);
        $this->expectExceptionMessage('Invalid command exception');

        $this->merchantsModule->executeCommand(new AddMerchantCommand(
            'Name',
            Country::PL,
            'registrationNumber',
            'invalid'
        ));
    }
}
