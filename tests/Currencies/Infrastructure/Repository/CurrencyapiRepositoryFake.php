<?php

namespace Tests\Currencies\Infrastructure\Repository;

use Hoyvoy\Currencies\Domain\DTO\CurrencyRateConversionDTO;
use Hoyvoy\Currencies\Domain\Interface\CurrencyRateConversionRepositoryInterface;

class CurrencyapiRepositoryFake implements CurrencyRateConversionRepositoryInterface
{

    public function getRateConversion(): CurrencyRateConversionDTO
    {
        return new CurrencyRateConversionDTO(
            [
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
            ]
        );
    }
}
