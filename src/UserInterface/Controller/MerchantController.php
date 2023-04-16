<?php

declare(strict_types=1);

namespace App\UserInterface\Controller;

use App\Application\Contract\MerchantsModuleInterface;
use App\Application\Merchant\AddMerchant\AddMerchantCommand;
use App\Application\Merchant\FindMerchantById\FindMerchantByIdQuery;
use App\Domain\Country;
use App\UserInterface\Request\AddMerchantRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Uid\Uuid;

final readonly class MerchantController
{
    public function __construct(
        private MerchantsModuleInterface $merchantsModule,
        private SerializerInterface $serializer,
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
        ], Response::HTTP_CREATED);
    }

    #[Route('/merchants/{merchantId}', methods: ['GET'])]
    public function findById(Uuid $merchantId): JsonResponse
    {
        $merchant = $this->merchantsModule->executeCQuery(new FindMerchantByIdQuery($merchantId));

        return new JsonResponse($this->serializer->serialize($merchant, 'json'), json: true);
    }
}
