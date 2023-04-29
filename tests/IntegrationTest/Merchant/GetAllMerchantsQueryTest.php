<?php

namespace App\Tests\IntegrationTest\Merchant;

use App\Application\Merchant\AddMerchant\AddMerchantCommand;
use App\Application\Merchant\GetAllMerchants\GetAllMerchantsQuery;
use App\Application\Merchant\GetAllMerchants\MerchantDTO;
use App\Domain\Country;
use App\Tests\IntegrationTest\IntegrationTestCase;

class GetAllMerchantsQueryTest extends IntegrationTestCase
{
    public function testThat_ReturnsAList_OfAllMerchants(): void
    {
        $this->merchantsModule->executeCommand(new AddMerchantCommand(
            'Name',
            Country::PL,
            'registrationNumber',
            'PL1234567890'
        ));

        $this->merchantsModule->executeCommand(new AddMerchantCommand(
            'Name UA',
            Country::UA,
            'registrationNumberUA',
            'UA1234567890'
        ));

        $merchants = $this->merchantsModule->executeQuery(new GetAllMerchantsQuery());

        $this->assertCount(2, $merchants);
        $this->assertContainsOnlyInstancesOf(MerchantDTO::class, $merchants);
    }
}
