<?php

namespace Hoyvoy\Currencies\Domain\Interface;

use Hoyvoy\Currencies\Domain\DTO\CurrencyRateConversionDTO;

interface CurrencyRateConversionRepositoryInterface
{
    public function getRateConversion(): CurrencyRateConversionDTO;
}
