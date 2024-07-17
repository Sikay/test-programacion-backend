<?php

namespace Hoyvoy\Currencies\Application\Update;

use Hoyvoy\Shared\Domain\Bus\Command\CommandHandler;
use Hoyvoy\Currencies\Domain\Service\CurrencyRateConversionUpdater;

class UpdateRateConversionCurrenciesCommandHandler implements CommandHandler
{
    public function __construct(private CurrencyRateConversionUpdater $currencyRateConversionUpdater)
    {
    }

    public function __invoke(UpdateRateConversionCurrenciesCommand $command): void
    {
        $this->currencyRateConversionUpdater->__invoke();
    }
}
