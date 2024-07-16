<?php

namespace Hoyvoy\Currencies\Domain\Entity;

use Hoyvoy\Currencies\Domain\ValueObject\CurrencyId;
use Hoyvoy\Currencies\Domain\ValueObject\CurrencyCode;
use Hoyvoy\Currencies\Domain\ValueObject\CurrencyName;
use Hoyvoy\Currencies\Domain\ValueObject\CurrencyRateUSD;

final class Currency
{
    public function __construct(
        public readonly CurrencyId $id,
        public readonly CurrencyName $name,
        public readonly CurrencyCode $code,
        public readonly CurrencyRateUSD $rateUsd,
    )
    {
    }

    public static function fromPrimitives(string $id, string $name, string $code, float $rateUSD)
    {
        return new self(
            new CurrencyId($id),
            new CurrencyName($name),
            new CurrencyCode($code),
            new CurrencyRateUSD($rateUSD)
        );
    }
}
