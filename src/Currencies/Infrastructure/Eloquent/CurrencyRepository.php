<?php

namespace Hoyvoy\Currencies\Infrastructure\Eloquent;

use Exception;
use Illuminate\Support\Facades\DB;
use Hoyvoy\Currencies\Domain\Entity\Currency;
use Hoyvoy\Currencies\Domain\Collection\Currencies;
use Hoyvoy\Currencies\Domain\ValueObject\CurrencyCode;
use Hoyvoy\Currencies\Domain\Exception\DatabaseException;
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

    private function toDomain(mixed $currency): Currency
    {
        return Currency::fromPrimitives(
            $currency['id'],
            $currency['name'],
            $currency['code'],
            $currency['rate_usd']
        );
    }

    public function saveAll(Currencies $currencies)
    {
        DB::beginTransaction();
        try {
            foreach ($currencies->all() as $currency) {
                $model = $this->model->find($currency->id->value());
                $model->name = $currency->name->value();
                $model->code = $currency->code->value();
                $model->rate_usd = $currency->rateUsd->value();
                $model->save();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new DatabaseException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious()
            );
        }
    }
}
