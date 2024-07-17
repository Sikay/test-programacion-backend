<?php

namespace Hoyvoy\Currencies\Domain\Service;

use Hoyvoy\Currencies\Domain\Collection\Currencies;
use Hoyvoy\Currencies\Domain\Interface\HistoricCurrencyRepositoryInterface;

class HistoricCurrencyUpdater
{
    public function __construct(private HistoricCurrencyRepositoryInterface $repository)
    {
    }

    public function __invoke(Currencies $currencies): void
    {
        $this->repository->save($currencies);
    }
}
