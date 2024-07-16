<?php

namespace Hoyvoy\Shared\Domain\ValueObject;

class FloatValueObject
{
    public function __construct(public readonly float $value)
    {
    }

    public function value(): float
    {
        return $this->value;
    }
}
