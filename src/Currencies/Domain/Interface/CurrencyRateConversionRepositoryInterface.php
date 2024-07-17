<?php

namespace Hoyvoy\Currencies\Domain\Interface;

use Hoyvoy\Currencies\Domain\Collection\CurrenciesRateConversion;

interface CurrencyRateConversionRepositoryInterface
{
    public function getRateConversion(): CurrenciesRateConversion;
}
