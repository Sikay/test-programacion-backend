<?php

namespace Hoyvoy\Currencies\Domain\Interface;

use Hoyvoy\Currencies\Domain\DTO\EmailDTO;

interface EmailRepositoryInterface
{
    public function sendEmail(EmailDTO $emailDTO): void;
}
