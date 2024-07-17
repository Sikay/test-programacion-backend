<?php

namespace Hoyvoy\Currencies\Domain\Interface;

use Hoyvoy\Currencies\Domain\Collection\Currencies;

interface HistoricCurrencyRepositoryInterface
{

    public function save(Currencies $currencies): void;
}
