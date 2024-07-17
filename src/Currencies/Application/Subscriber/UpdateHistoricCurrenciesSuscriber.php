<?php

namespace Hoyvoy\Currencies\Application\Subscriber;

use Hoyvoy\Currencies\Domain\Collection\Currencies;
use Hoyvoy\Currencies\Domain\Event\HistoricCurrencyRate;
use Hoyvoy\Shared\Domain\Bus\Event\DomainEventSubscriber;
use Hoyvoy\Currencies\Domain\Service\HistoricCurrencyUpdater;

class UpdateHistoricCurrenciesSuscriber implements DomainEventSubscriber
{
    public function __construct(private HistoricCurrencyUpdater $historicCurrencyUpdater)
    {
    }

    public function __invoke($event): void
    {
        $currencies = new Currencies($event->currencies);
        $this->historicCurrencyUpdater->__invoke($currencies);
    }

    public static function subscribedTo(): array
    {
        return [
            HistoricCurrencyRate::class
        ];
    }
}
