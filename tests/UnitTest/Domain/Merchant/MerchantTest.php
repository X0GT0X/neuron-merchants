<?php

declare(strict_types=1);

namespace App\Tests\UnitTest\Domain\Merchant;

use App\Domain\Country;
use App\Domain\Merchant\Event\MerchantCreatedDomainEvent;
use App\Domain\Merchant\Merchant;
use App\Domain\Merchant\MerchantCounterInterface;
use App\Domain\Merchant\Rule\RegistrationNumberShouldBeUniqueRule;
use App\Domain\Merchant\Rule\TaxNumberShouldBeUniqueRule;
use App\Tests\UnitTest\UnitTestCase;

class MerchantTest extends UnitTestCase
{
    public function testThat_SuccessfullyCreates_NewMerchant(): void
    {
        $merchantCounter = $this->createMock(MerchantCounterInterface::class);
        $merchantCounter->expects($this->once())
            ->method('countWithRegistrationNumber')
            ->with('registrationNumber')
            ->willReturn(0);

        $merchantCounter->expects($this->once())
            ->method('countWithTaxNumber')
            ->with('PL1234567890')
            ->willReturn(0);

        $merchant = Merchant::createNew(
            'Name',
            Country::PL,
            'registrationNumber',
            'PL1234567890',
            $merchantCounter
        );

        /** @var MerchantCreatedDomainEvent $domainEvent */
        $domainEvent = $this->assertPublishedDomainEvents($merchant, MerchantCreatedDomainEvent::class)[0];

        $this->assertEquals($merchant->id, $domainEvent->merchantId);
    }

    public function testThat_CreatingNewMerchant_WithNonUniqueRegistrationNumber_BreaksRegistrationNumberShouldBeUniqueRule(): void
    {
        $merchantCounter = $this->createMock(MerchantCounterInterface::class);
        $merchantCounter->expects($this->once())
            ->method('countWithRegistrationNumber')
            ->with('registrationNumber')
            ->willReturn(1);

        $this->expectBrokenRule(
            RegistrationNumberShouldBeUniqueRule::class,
            'Merchant with registration number \'registrationNumber\' already exists',
            static fn () => Merchant::createNew(
                'Name',
                Country::PL,
                'registrationNumber',
                'PL1234567890',
                $merchantCounter
            )
        );
    }

    public function testThat_CreatingNewMerchant_WithNonUniqueTaxNumber_BreaksTaxNumberShouldBeUniqueRule(): void
    {
        $merchantCounter = $this->createMock(MerchantCounterInterface::class);
        $merchantCounter->expects($this->once())
            ->method('countWithTaxNumber')
            ->with('PL1234567890')
            ->willReturn(1);

        $this->expectBrokenRule(
            TaxNumberShouldBeUniqueRule::class,
            'Merchant with tax number \'PL1234567890\' already exists',
            static fn () => Merchant::createNew(
                'Name',
                Country::PL,
                'registrationNumber',
                'PL1234567890',
                $merchantCounter
            )
        );
    }
}
