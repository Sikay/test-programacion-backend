<?php

namespace Hoyvoy\Currencies\Application\Get;

use Hoyvoy\Currencies\Domain\CurrencyFindAll;
use Hoyvoy\Shared\Domain\Bus\Query\QueryHandler;
use Hoyvoy\Currencies\Application\Response\CurrenciesResponse;

class GetCurrenciesQueryHandler implements QueryHandler
{
    public function __construct(public readonly CurrencyFindAll $currencyFindAll)
    {
    }

    public function __invoke(GetCurrenciesQuery $query): CurrenciesResponse
    {
        $currencies = $this->currencyFindAll->__invoke();
        return CurrenciesResponse::fromCurrencies($currencies);
    }
}
