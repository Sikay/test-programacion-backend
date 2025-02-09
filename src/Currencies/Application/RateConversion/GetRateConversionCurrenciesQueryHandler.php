<?php

namespace Hoyvoy\Currencies\Application\RateConversion;

use Hoyvoy\Shared\Domain\Bus\Query\QueryHandler;
use Hoyvoy\Currencies\Domain\Service\CurrencyFindByCode;
use Hoyvoy\Currencies\Domain\ValueObject\CurrencyCode;
use Hoyvoy\Shared\Domain\ValueObject\FloatValueObject;
use Hoyvoy\Currencies\Domain\Service\CurrencyRateConversor;
use Hoyvoy\Currencies\Application\RateConversion\Response\RateConversionResponse;

class GetRateConversionCurrenciesQueryHandler implements QueryHandler
{
    public function __construct(
        private CurrencyFindByCode     $currencyFinder,
        private CurrencyRateConversor $currencyRateConversion
    )
    {
    }

    public function __invoke(GetRateConversionCurrenciesQuery $query): RateConversionResponse
    {
        $fromCode = new CurrencyCode($query->from);
        $fromCurrency = $this->currencyFinder->__invoke($fromCode);

        $toCode = new CurrencyCode($query->to);
        $toCurrency = $this->currencyFinder->__invoke($toCode);

        $amount = new FloatValueObject($query->amount);

        $conversion = $this->currencyRateConversion->__invoke(
            $fromCurrency,
            $toCurrency,
            $amount
        );

        return new RateConversionResponse(
            $conversion->from,
            $conversion->to,
            $conversion->amount,
            $conversion->result
        );
    }
}
