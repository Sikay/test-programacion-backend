<?php

namespace Hoyvoy\Currencies\Domain\Service;

use Hoyvoy\Currencies\Domain\Collection\Currencies;
use Hoyvoy\Currencies\Domain\Interface\CurrencyRepositoryInterface;

final class CurrencyFindAll
{
    public function __construct(private CurrencyRepositoryInterface $repository)
    {
    }

    public function __invoke(): Currencies
    {
        return $this->repository->findAll();
    }
}
