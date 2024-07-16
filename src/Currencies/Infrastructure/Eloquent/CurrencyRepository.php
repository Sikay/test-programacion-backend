<?php

namespace Hoyvoy\Currencies\Infrastructure\Eloquent;

use Hoyvoy\Shared\Domain\ArrUtils;
use Hoyvoy\Currencies\Domain\Entity\Currency;
use Hoyvoy\Currencies\Domain\Collection\Currencies;
use Hoyvoy\Currencies\Domain\ValueObject\CurrencyCode;
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
            return $this->toDomain($currency);
        }, $eloquentCurrencies->toArray());


        return new Currencies($currencies);
    }

    public function findByCode(CurrencyCode $code)
    {
        $eloquentCurrency = $this->model->where('code', $code->value())->first();

        if ($eloquentCurrency === null) {
            return null;
        }

        return $this->toDomain($eloquentCurrency->toArray());
    }

    function toDomain(mixed $currency): Currency
    {
        return Currency::fromPrimitives(
            $currency['id'],
            $currency['name'],
            $currency['code'],
            $currency['rate_usd']
        );
    }
}
