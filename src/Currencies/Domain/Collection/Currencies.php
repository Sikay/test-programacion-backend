<?php

namespace Hoyvoy\Currencies\Domain\Collection;

use Hoyvoy\Shared\Domain\AbstractCollection;
use Hoyvoy\Currencies\Domain\Entity\Currency;

class Currencies extends AbstractCollection
{
    protected function type(): string
    {
        return Currency::class;
    }
}
