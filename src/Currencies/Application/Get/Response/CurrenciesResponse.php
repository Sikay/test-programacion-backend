<?php

namespace Hoyvoy\Currencies\Application\Get\Response;

use Hoyvoy\Shared\Domain\Bus\Query\Response;
use Hoyvoy\Currencies\Domain\Entity\Currency;
use Hoyvoy\Currencies\Domain\Collection\Currencies;

final class CurrenciesResponse implements Response
{
    public function __construct(private array $currencies)
    {
    }

    public static function fromCurrencies(Currencies $currencies): self
    {
        $currenciesResponses = array_map(
            function (Currency $currency) {
                return CurrencyResponse::fromCurrency($currency);
            },
            $currencies->all()
        );
        return new self($currenciesResponses);
    }

    public function jsonSerialize(): array
    {
        return array_map(function (CurrencyResponse $boardResponse) {
            return $boardResponse->jsonSerialize();
        }, $this->currencies);
    }
}
