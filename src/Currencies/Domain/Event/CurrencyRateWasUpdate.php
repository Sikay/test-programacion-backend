<?php

namespace Hoyvoy\Currencies\Domain\Event;

use Hoyvoy\Shared\Domain\Bus\Event\DomainEvent;

class CurrencyRateWasUpdate extends DomainEvent
{
    public function __construct(
        public readonly array $currencies,
        string $eventId = null,
        string $occurredAt = null)
    {
        parent::__construct(null, $eventId, $occurredAt);
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredAt
    ): DomainEvent
    {
        return new self($body, $eventId, $occurredAt);
    }

    public static function eventName(): string
    {
        return 'currency_rate.was_updated';
    }

    public function toPrimitives(): array
    {
        return [
            'currencies' => $this->currencies,
        ];
    }
}
