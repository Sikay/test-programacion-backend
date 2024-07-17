<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hoyvoy\Currencies\Infrastructure\Eloquent\CurrencyModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        CurrencyModel::factory(['code' => 'EUR'])->create();
        CurrencyModel::factory(['code' => 'USD'])->create();
        CurrencyModel::factory(['code' => 'JPY'])->create();
        CurrencyModel::factory(['code' => 'GBP'])->create();
    }
}
