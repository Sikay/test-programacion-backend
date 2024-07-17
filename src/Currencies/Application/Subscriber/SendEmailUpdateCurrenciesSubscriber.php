<?php

namespace Hoyvoy\Currencies\Application\Subscriber;

use Hoyvoy\Currencies\Domain\Service\CurrencyRateUpdateEmailSender;
use Hoyvoy\Currencies\Domain\Collection\Currencies;
use Hoyvoy\Shared\Domain\Bus\Event\DomainEventSubscriber;
use Hoyvoy\Currencies\Domain\Event\CurrencyRateWasUpdate;

class SendEmailUpdateCurrenciesSubscriber implements DomainEventSubscriber
{
    public function __construct(private CurrencyRateUpdateEmailSender $emailSender)
    {
    }

    public function __invoke($event): void
    {
        $currencies = new Currencies($event->currencies);
        $this->emailSender->__invoke($currencies);
    }

    public static function subscribedTo(): array
    {
        return [
            CurrencyRateWasUpdate::class
        ];
    }
}
