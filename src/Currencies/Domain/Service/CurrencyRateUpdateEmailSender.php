<?php

namespace Hoyvoy\Currencies\Domain\Service;

use Hoyvoy\Currencies\Domain\Collection\Currencies;
use Hoyvoy\Currencies\Domain\Interface\EmailRepositoryInterface;

class CurrencyRateUpdateEmailSender
{
    public function __construct(private EmailRepositoryInterface $emailRepository)
    {
    }

    public function __invoke(Currencies $currencies): void
    {
        $body = 'prueba';

        $this->emailRepository->sendEmail(
//            'cambio@moneda.es',
            'pedrohdezmora.trabajo@gmail.com',
            'from@example.com',
            'Currencies Rate Update',
            $body
        );
    }
}
