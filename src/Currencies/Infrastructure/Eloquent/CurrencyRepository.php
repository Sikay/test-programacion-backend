<?php

namespace Hoyvoy\Currencies\Infrastructure\Eloquent;

use Hoyvoy\Shared\Domain\ArrUtils;
use Hoyvoy\Currencies\Domain\Entity\Currency;
use Hoyvoy\Currencies\Domain\Collection\Currencies;
use Hoyvoy\Currencies\Domain\Interface\CurrencyRepositoryInterface;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    private CurrencyModel $model;

    public function __construct(CurrencyModel $model)
    {
        $this->model = $model;
    }

    public function findAll(): Currencies
    {
        $eloquentCurrencies = $this->model->all();

        $currencies = array_map(function ($currency) {
            return Currency::fromPrimitives(
                $currency['id'],
                $currency['name'],
                $currency['code'],
                $currency['rate_usd']
            );
        }, $eloquentCurrencies->toArray());


        return new Currencies($currencies);
    }
}
