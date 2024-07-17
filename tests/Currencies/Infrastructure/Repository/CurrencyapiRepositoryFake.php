<?php

namespace Tests\Currencies\Infrastructure\Repository;

use Hoyvoy\Currencies\Domain\Entity\CurrencyRateConversion;
use Hoyvoy\Currencies\Domain\Collection\CurrenciesRateConversion;
use Hoyvoy\Currencies\Domain\Interface\CurrencyRateConversionRepositoryInterface;

class CurrencyapiRepositoryFake implements CurrencyRateConversionRepositoryInterface
{

    public function getRateConversion(): CurrenciesRateConversion
    {
        $data = [
            'USD' => [
                'code' => 'USD',
                'value' => 1.0
            ],
            'EUR' => [
                'code' => 'EUR',
                'value' => 1.06
            ],
            'JPY' => [
                'code' => 'JPY',
                'value' => 0.008
            ],
            'GBP' => [
                'code' => 'GBP',
                'value' => 1.25
            ],
        ];

        $currencies = array_map(function ($currency) {
            return $this->toDomain($currency);
        }, $data);

        return new CurrenciesRateConversion($currencies);
    }

    private function toDomain(mixed $currency): CurrencyRateConversion
    {
        return CurrencyRateConversion::fromPrimitives(
            $currency['code'],
            $currency['value']
        );
    }
}
