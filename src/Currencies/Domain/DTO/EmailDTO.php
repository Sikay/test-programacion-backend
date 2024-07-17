<?php

namespace Hoyvoy\Currencies\Domain\DTO;

class EmailDTO
{
    public function __construct(
        public readonly string $to,
        public readonly string $subject,
        public readonly string $body
    )
    {
    }
}
