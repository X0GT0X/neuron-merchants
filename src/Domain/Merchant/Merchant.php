<?php

declare(strict_types=1);

namespace App\Domain\Merchant;

use App\BuildingBlocks\Domain\AggregateRootInterface;
use App\BuildingBlocks\Domain\Entity;
use App\Domain\Country;
use App\Domain\Merchant\Event\MerchantCreatedDomainEvent;
use App\Domain\Merchant\Rule\RegistrationNumberShouldBeUniqueRule;
use App\Domain\Merchant\Rule\TaxNumberShouldBeUniqueRule;
use Symfony\Component\Uid\Uuid;

class Merchant extends Entity implements AggregateRootInterface
{
    public MerchantId $id;

    private string $name;

    private Country $country;

    private string $registrationNumber;

    private string $taxNumber;

    private bool $isActive;

    private \DateTimeImmutable $createdAt;

    private ?\DateTimeImmutable $updatedAt = null;

    private function __construct(string $name, Country $country, string $registrationNumber, string $taxNumber, MerchantCounterInterface $merchantCounter)
    {
        $this->checkRules(
            new RegistrationNumberShouldBeUniqueRule($registrationNumber, $merchantCounter),
            new TaxNumberShouldBeUniqueRule($taxNumber, $merchantCounter),
        );

        $this->id = new MerchantId(Uuid::v4());
        $this->name = $name;
        $this->country = $country;
        $this->registrationNumber = $registrationNumber;
        $this->taxNumber = $taxNumber;
        $this->isActive = true;
        $this->createdAt = new \DateTimeImmutable();

        $this->addDomainEvent(new MerchantCreatedDomainEvent($this->id));
    }

    public static function createNew(string $name, Country $country, string $registrationNumber, string $taxNumber, MerchantCounterInterface $merchantCounter): self
    {
        return new self($name, $country, $registrationNumber, $taxNumber, $merchantCounter);
    }
}
