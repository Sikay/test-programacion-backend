<?php

namespace Hoyvoy\Currencies\Domain\DTO;

class RateConversionDTO
{
    public function __construct(
        public readonly string $from,
        public readonly string $to,
        public readonly float $amount,
        public readonly float $result
    ) {
    }
}
