<?php

namespace Hoyvoy\Currencies\Domain\Service;

use Hoyvoy\Shared\Domain\Bus\Event\EventBus;
use Hoyvoy\Currencies\Domain\ValueObject\CurrencyRateUSD;
use Hoyvoy\Currencies\Domain\Interface\CurrencyRepositoryInterface;
use Hoyvoy\Currencies\Domain\Interface\CurrencyRateConversionRepositoryInterface;

class CurrencyRateConversionUpdater
{
    public function __construct(
        private CurrencyRateConversionRepositoryInterface $currencyRateConversionRepository,
        private CurrencyRepositoryInterface $currencyRepository,
    )
    {
    }

    public function __invoke(): void
    {
        $currenciesRateConversion = $this->currencyRateConversionRepository->getRateConversion();
        $currencies = $this->currencyRepository->findAll();

        foreach ($currenciesRateConversion->all() as $currencyRateConversion) {
            $currency = $currencies->findByCode($currencyRateConversion->code->value());
            if (!empty($currency)) {
                $currency->setRateUsd(new CurrencyRateUSD($currencyRateConversion->rate->value()));
            }
        }

        $this->currencyRepository->saveAll($currencies);
    }
}
