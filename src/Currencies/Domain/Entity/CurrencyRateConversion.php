<?php

namespace Hoyvoy\Currencies\Domain\Entity;

use Hoyvoy\Currencies\Domain\ValueObject\CurrencyRateConversionCode;
use Hoyvoy\Currencies\Domain\ValueObject\CurrencyRateConversionValue;

class CurrencyRateConversion
{
    public function __construct(
        public readonly CurrencyRateConversionCode  $code,
        public readonly CurrencyRateConversionValue $rate,
    ) {
    }

    public static function fromPrimitives(string $code, string $rate): self
    {
        return new self(
            new CurrencyRateConversionCode($code),
            new CurrencyRateConversionValue($rate),
        );
    }
}
