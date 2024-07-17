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
        $currencyRateConversionDTO = $this->currencyRateConversionRepository->getRateConversion();
        $currencies = $this->currencyRepository->findAll();

        foreach ($currencyRateConversionDTO->rates as $currencyCode => $rate) {
            $currency = $currencies->findByCode($currencyCode);
            if (!empty($currency)) {
                $currency->setRateUsd(new CurrencyRateUSD($rate['value']));
            }
        }

        $this->currencyRepository->saveAll($currencies);
    }
}
