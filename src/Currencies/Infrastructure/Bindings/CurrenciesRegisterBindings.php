<?php

namespace Hoyvoy\Currencies\Infrastructure\Bindings;

use Hoyvoy\Currencies\Infrastructure\Eloquent\CurrencyRepository;
use Hoyvoy\Currencies\Domain\Interface\CurrencyRepositoryInterface;

class CurrenciesRegisterBindings
{
    public function singletons(): array
    {
        return [
            CurrencyRepositoryInterface::class => CurrencyRepository::class
        ];
    }
}
