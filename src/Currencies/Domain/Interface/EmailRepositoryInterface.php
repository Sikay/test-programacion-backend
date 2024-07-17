<?php

namespace Hoyvoy\Currencies\Domain\Interface;

interface EmailRepositoryInterface
{
    public function sendEmail(string $to, string $from, string $subject, string $body): void;
}
