<?php

namespace Hoyvoy\Currencies\Infrastructure\Bindings;

use Hoyvoy\Currencies\Infrastructure\Email\EmailRepository;
use Hoyvoy\Currencies\Domain\Interface\EmailRepositoryInterface;
use Hoyvoy\Currencies\Infrastructure\Eloquent\CurrencyRepository;
use Hoyvoy\Currencies\Domain\Interface\CurrencyRepositoryInterface;
use Hoyvoy\Currencies\Infrastructure\CurrencyRate\CurrencyapiRepository;
use Hoyvoy\Currencies\Domain\Interface\CurrencyRateConversionRepositoryInterface;

class CurrenciesRegisterBindings
{
    public function singletons(): array
    {
        return [
            CurrencyRepositoryInterface::class => CurrencyRepository::class,
            CurrencyRateConversionRepositoryInterface::class => CurrencyapiRepository::class,
            EmailRepositoryInterface::class => EmailRepository::class,
        ];
    }
}
