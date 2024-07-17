<?php

namespace Hoyvoy\Currencies\Infrastructure\Eloquent;

use Hoyvoy\Currencies\Domain\Collection\Currencies;
use Hoyvoy\Currencies\Domain\Interface\HistoricCurrencyRepositoryInterface;

class HistoricCurrencyRepository implements HistoricCurrencyRepositoryInterface
{
    private CurrencyHistoricModel $model;

    public function __construct(CurrencyHistoricModel $model)
    {
        $this->model = $model;
    }

    public function save(Currencies $currencies): void
    {
        foreach ($currencies->all() as $currency) {
            $model = new $this->model;
            $model->fk_currency_id = $currency->id->value();
            $model->name = $currency->name->value();
            $model->code = $currency->code->value();
            $model->rate_usd = $currency->rateUsd->value();
            $model->save();
        }
    }
}
