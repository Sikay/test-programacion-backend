<?php

namespace Hoyvoy\Currencies\Infrastructure\Eloquent;

use Exception;
use Illuminate\Support\Facades\DB;
use Hoyvoy\Currencies\Domain\Collection\Currencies;
use Hoyvoy\Currencies\Domain\Exception\DatabaseException;
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
        DB::beginTransaction();
        try {
            foreach ($currencies->all() as $currency) {
                $model = new $this->model;
                $model->fk_currency_id = $currency->id->value();
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
