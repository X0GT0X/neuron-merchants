<?php

namespace App\UserInterface\Controller;

use App\Application\Contract\MerchantsModuleInterface;
use App\Application\Merchant\AddMerchant\AddMerchantCommand;
use App\Domain\Country;
use App\UserInterface\Request\AddMerchantRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final readonly class MerchantController
{
    public function __construct(
        private MerchantsModuleInterface $merchantsModule
    ) {
    }

    #[Route('/merchants', methods: ['POST'])]
    public function add(AddMerchantRequest $request): JsonResponse
    {
        $merchantId = $this->merchantsModule->executeCommand(new AddMerchantCommand(
            (string) $request->name,
            Country::from((string) $request->country),
            (string) $request->registrationNumber,
            (string) $request->taxNumber
        ));

        return new JsonResponse([
            'merchantId' => $merchantId,
        ]);
    }
}
