<?php

namespace Hoyvoy\Currencies\Application\Response;

use Hoyvoy\Shared\Domain\Bus\Query\Response;
use Hoyvoy\Currencies\Domain\Entity\Currency;

class CurrencyResponse implements Response
{
    public function __construct(
        public readonly string $name,
        public readonly string $code,
        public readonly float $rateUsd
    ) {
    }

    public static function fromBoard(Currency $currency): self
    {
        return new self(
            $currency->name->value(),
            $currency->code->value(),
            $currency->rateUsd->value()
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'rate_USD' => $this->rateUsd,
        ];
    }
}
