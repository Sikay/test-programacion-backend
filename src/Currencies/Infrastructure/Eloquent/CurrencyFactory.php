<?php

namespace Hoyvoy\Currencies\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    protected $model = CurrencyModel::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'name' => $this->faker->name,
            'code' => $this->faker->currencyCode,
            'rate_usd' => $this->faker->randomFloat(2, 0, 3)
        ];
    }
}
