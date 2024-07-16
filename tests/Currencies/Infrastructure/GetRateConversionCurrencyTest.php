<?php

namespace Tests\Currencies\Infrastructure;

use Tests\TestCase;
use Hoyvoy\Currencies\Infrastructure\Eloquent\CurrencyModel;

class GetRateConversionCurrencyTest extends TestCase
{
    public function test_should_calculate_currency_result(): void
    {
        $currencyFrom = CurrencyModel::factory(['code' => 'EUR', 'rate_usd' => 1.06])->create();
        $currencyTo = CurrencyModel::factory(['code' => 'USD', 'rate_usd' => 1])->create();
        $totalCurrencyConversion = 1.06;
        $amountToConvert = 1;

        $request = [
            'from' => $currencyFrom->code,
            'to' => $currencyTo->code,
            'amount' => $amountToConvert,
        ];

        $url = 'api/currencies/rate-conversion';
        $response = $this->get($this->formatGetUrl($request, $url));

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'from' => $currencyFrom->code,
            'to' => $currencyTo->code,
            'amount' => $amountToConvert,
            'result' => $totalCurrencyConversion
        ]);
    }

    private function formatGetUrl(array $request, string $url): string
    {
        $url .= '?';
        foreach ($request as $key => $value) {
            $url .= $key . '=' . $value . '&';
        }
        return $url;
    }
}
