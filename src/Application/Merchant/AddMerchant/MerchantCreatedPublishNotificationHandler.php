<?php

declare(strict_types=1);

namespace App\Application\Merchant\AddMerchant;

use App\Domain\Merchant\Event\MerchantCreatedDomainEvent;
use App\IntegrationEvent\MerchantCreatedIntegrationEvent;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
final readonly class MerchantCreatedPublishNotificationHandler
{
    public function __construct(
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(MerchantCreatedNotification $notification): void
    {
        $domainEvent = $notification->getDomainEvent();

        if ($domainEvent instanceof MerchantCreatedDomainEvent) {
            $this->eventBus->dispatch(new MerchantCreatedIntegrationEvent(
                $notification->getId(),
                $domainEvent->getOccurredOn(),
                $domainEvent->merchantId->getValue()
            ), [new AmqpStamp('notifications')]);
        }
    }
}
