<?php

namespace Hoyvoy\Currencies\Domain\Collection;

use Hoyvoy\Shared\Domain\AbstractCollection;
use Hoyvoy\Currencies\Domain\Entity\CurrencyRateConversion;

class CurrenciesRateConversion extends AbstractCollection
{
    protected function type(): string
    {
        return CurrencyRateConversion::class;
    }
}
