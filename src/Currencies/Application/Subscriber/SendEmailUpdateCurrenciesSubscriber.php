<?php

namespace Hoyvoy\Currencies\Application\Subscriber;

use Hoyvoy\Shared\Domain\Bus\Event\DomainEventSubscriber;
use Hoyvoy\Currencies\Domain\Event\CurrencyRateWasUpdate;

class SendEmailUpdateCurrenciesSubscriber implements DomainEventSubscriber
{
    public function __invoke($event): void
    {
        // TODO: Implement __invoke() method.
    }

    public static function subscribedTo(): array
    {
        return [
            CurrencyRateWasUpdate::class
        ];
    }
}
