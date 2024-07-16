<?php

namespace Hoyvoy\Currencies\Domain\Service;

use Hoyvoy\Currencies\Domain\Entity\Currency;
use Hoyvoy\Currencies\Domain\ValueObject\CurrencyCode;
use Hoyvoy\Currencies\Domain\Exception\CurrencyNotFoundException;
use Hoyvoy\Currencies\Domain\Interface\CurrencyRepositoryInterface;

final class CurrencyFindByCode
{
    public function __construct(private CurrencyRepositoryInterface $repository)
    {
    }

    public function __invoke(CurrencyCode $code): Currency
    {
        $currency = $this->repository->findByCode($code);

        if ($currency === null) {
            throw new CurrencyNotFoundException($code);
        }

        return $currency;
    }
}
