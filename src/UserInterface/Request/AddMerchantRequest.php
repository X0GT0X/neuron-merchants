<?php

declare(strict_types=1);

namespace App\UserInterface\Request;

use App\Domain\Country;
use Neuron\BuildingBlocks\UserInterface\Request\RequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

readonly class AddMerchantRequest implements RequestInterface
{
    public function __construct(
        #[Assert\NotBlank(message: 'Name must be provided', allowNull: false)]
        public ?string $name,
        #[Assert\NotBlank(message: 'Country must be provided', allowNull: false)]
        #[Assert\Choice(callback: [Country::class, 'values'], message: 'Provided value {{ value }} is not one of the supported countries. Try one of {{{ choices }}}')]
        public ?string $country,
        #[Assert\NotBlank(message: 'Registration number must be provided', allowNull: false)]
        public ?string $registrationNumber,
        #[Assert\NotBlank(message: 'Tax number must be provided', allowNull: false)]
        public ?string $taxNumber,
    ) {
    }
}
