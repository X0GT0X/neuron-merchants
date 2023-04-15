<?php

declare(strict_types=1);

namespace App\Application\Merchant\AddMerchant;

use App\Application\Contract\AbstractCommand;
use App\Domain\Country;
use Symfony\Component\Validator\Constraints as Assert;

class AddMerchantCommand extends AbstractCommand
{
    public function __construct(
        public readonly string $name,
        public readonly Country $country,
        #[Assert\Regex('/^[A-Za-z0-9]+$/', message: 'Registration number must contain only alphanumeric characters')]
        public readonly string $registrationNumber,
        #[Assert\Regex('/[A-Z][A-Z]\d{10}/', message: 'Provided tax number is not in a valid format')]
        public readonly string $taxNumber,
    ) {
        parent::__construct();
    }
}
