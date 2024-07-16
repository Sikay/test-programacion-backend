<?php

namespace Hoyvoy\Currencies\Domain\Interface;

use Hoyvoy\Currencies\Domain\Collection\Currencies;

interface CurrencyRepositoryInterface
{
    public function findAll(): Currencies;
}
