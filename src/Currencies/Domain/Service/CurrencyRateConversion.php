<?php

namespace Hoyvoy\Currencies\Domain\Service;

use Hoyvoy\Currencies\Domain\Entity\Currency;
use Hoyvoy\Currencies\Domain\DTO\RateConversionDTO;
use Hoyvoy\Shared\Domain\ValueObject\FloatValueObject;

final class CurrencyRateConversion
{
    public function __invoke(Currency $fromCurrency, Currency $toCurrency, FloatValueObject $amount): RateConversionDTO
    {
        $fromConversionToUSD = $amount->value() * $fromCurrency->rateUsd->value();
        $totalConversion = $fromConversionToUSD / $toCurrency->rateUsd->value();

        return new RateConversionDTO(
            $fromCurrency->code->value(),
            $toCurrency->code->value(),
            $amount->value(),
            $totalConversion
        );
    }
}
