<?php

namespace Tests\Currencies\Infrastructure;

use Tests\TestCase;
use Hoyvoy\Currencies\Infrastructure\Eloquent\CurrencyModel;

class GetCurrenciesTest extends TestCase
{
    public function test_should_list_currencies(): void
    {
        CurrencyModel::factory(5)->create();
        $response = $this->get('api/currencies');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'code',
                    'name',
                    'rate_USD',
                ],
            ],
        ]);
    }
}
