<?php

declare(strict_types=1);

namespace App\Application\Merchant\AddMerchant;

use App\Application\Configuration\Command\CommandHandlerInterface;
use App\Domain\Merchant\Merchant;
use App\Domain\Merchant\MerchantCounterInterface;
use App\Domain\Merchant\MerchantRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
final readonly class AddMerchantCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private MerchantRepositoryInterface $merchantRepository,
        private MerchantCounterInterface $merchantCounter
    ) {
    }

    public function __invoke(AddMerchantCommand $command): Uuid
    {
        $merchant = Merchant::createNew(
            $command->name,
            $command->country,
            $command->registrationNumber,
            $command->taxNumber,
            $this->merchantCounter,
        );

        $this->merchantRepository->add($merchant);

        return $merchant->id->getValue();
    }
}
