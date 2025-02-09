<?php

namespace Hoyvoy\Currencies\Domain\Service;

use Hoyvoy\Shared\Domain\Bus\Event\EventBus;
use Hoyvoy\Currencies\Domain\Entity\Currency;
use Hoyvoy\Currencies\Domain\Event\HistoricCurrencyRate;
use Hoyvoy\Currencies\Domain\ValueObject\CurrencyRateUSD;
use Hoyvoy\Currencies\Domain\Event\CurrencyRateWasUpdate;
use Hoyvoy\Currencies\Domain\Interface\CurrencyRepositoryInterface;
use Hoyvoy\Currencies\Domain\Interface\CurrencyRateConversionRepositoryInterface;

class CurrencyRateUpdater
{
    public function __construct(
        private CurrencyRateConversionRepositoryInterface $currencyRateConversionRepository,
        private CurrencyRepositoryInterface $currencyRepository,
        private EventBus $eventBus
    )
    {
    }

    public function __invoke(): void
    {
        $currenciesRateConversion = $this->currencyRateConversionRepository->getRateConversion();
        $currencies = $this->currencyRepository->findAll();

        $oldCurrencies = [];
        $updateCurrencies = [];
        foreach ($currenciesRateConversion->all() as $currencyRateConversion) {
            $currency = $currencies->findByCode($currencyRateConversion->code->value());
            if (!empty($currency)) {
                $oldCurrencies[] = Currency::fromPrimitives(
                    $currency->id->value(),
                    $currency->name->value(),
                    $currency->code->value(),
                    $currency->rateUsd->value()
                );
                $currency->setRateUsd(new CurrencyRateUSD($currencyRateConversion->rate->value()));
                $updateCurrencies[] = $currency;
            }
        }

        $this->currencyRepository->saveAll($currencies);
        if (!empty($updateCurrencies)) {
            $this->eventBus->publish(new CurrencyRateWasUpdate($updateCurrencies));
        }
        if (!empty($oldCurrencies)) {
            $this->eventBus->publish(new HistoricCurrencyRate($oldCurrencies));
        }
    }
}
