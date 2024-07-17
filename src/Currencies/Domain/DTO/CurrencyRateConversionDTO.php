<?php

namespace Hoyvoy\Currencies\Domain\DTO;

class CurrencyRateConversionDTO
{
    public function __construct(
        public readonly array $rates
    ) {
    }
}
