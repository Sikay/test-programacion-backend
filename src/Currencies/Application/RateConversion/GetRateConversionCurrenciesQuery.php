<?php

namespace Hoyvoy\Currencies\Application\RateConversion;

use Hoyvoy\Shared\Domain\Bus\Query\Query;

class GetRateConversionCurrenciesQuery implements Query
{
    public function __construct(
        public readonly string $from,
        public readonly string $to,
        public readonly float $amount
    )
    {
    }
}
