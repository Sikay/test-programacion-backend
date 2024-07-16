<?php

namespace Hoyvoy\Currencies\Domain\Interface;

use Hoyvoy\Currencies\Domain\Collection\Currencies;
use Hoyvoy\Currencies\Domain\ValueObject\CurrencyCode;

interface CurrencyRepositoryInterface
{
    public function findAll(): Currencies;

    public function findByCode(CurrencyCode $code);
}
