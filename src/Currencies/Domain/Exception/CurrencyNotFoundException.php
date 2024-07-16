<?php

namespace Hoyvoy\Currencies\Domain\Exception;

class CurrencyNotFoundException extends \Exception
{
    public function __construct($code)
    {
        parent::__construct(sprintf('Currency with code %s not found', $code));
    }
}
