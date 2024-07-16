<?php

namespace Hoyvoy\Shared\Domain\ValueObject;

use Ramsey\Uuid\Uuid;
use InvalidArgumentException;

class UuidValueObject
{
    public function __construct(public readonly string $value)
    {
        $this->assertIsValidUuid($value);
    }

    private function assertIsValidUuid(string $id): void
    {
        if (!Uuid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('`<%s>` does not allow the value `<%s>`.', static::class, $id));
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
