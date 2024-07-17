<?php

namespace Hoyvoy\Currencies\Infrastructure\CurrencyRate;

use GuzzleHttp\Client;
use Hoyvoy\Currencies\Domain\Entity\CurrencyRateConversion;
use Hoyvoy\Currencies\Domain\Collection\CurrenciesRateConversion;
use Hoyvoy\Currencies\Domain\Interface\CurrencyRateConversionRepositoryInterface;

class CurrencyapiRepository implements CurrencyRateConversionRepositoryInterface
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getRateConversion(): CurrenciesRateConversion
    {
        $response = $this->client->get('https://api.currencyapi.com/v3/latest', [
            'query' => [
                'apikey' => config('app.currency_api_key')
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        $currencies = array_map(function ($currency) {
            return $this->toDomain($currency);
        }, $data['data']);

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
