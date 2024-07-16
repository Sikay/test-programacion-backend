<?php

namespace Hoyvoy\Shared\Domain\ValueObject;

class StringValueObject
{
    public function __construct(public readonly string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}
