<?php

namespace Hoyvoy\Currencies\Application\RateConversion\Response;

use Hoyvoy\Shared\Domain\Bus\Query\Response;

class RateConversionResponse implements Response
{
    public function __construct(
        public readonly string $from,
        public readonly string $to,
        public readonly float $amount,
        public readonly float $result
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'from' => $this->from,
            'to' => $this->to,
            'amount' => $this->amount,
            'result' => $this->result,
        ];
    }
}
