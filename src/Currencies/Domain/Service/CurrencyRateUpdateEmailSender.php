<?php

namespace Hoyvoy\Currencies\Domain\Service;

use Hoyvoy\Currencies\Domain\Collection\Currencies;
use Hoyvoy\Currencies\Domain\Interface\EmailRepositoryInterface;

class CurrencyRateUpdateEmailSender
{
    private const EMAIL_A_NOTIFICAR = 'cambio@moneda.es';
    private const MESSAGE_CURRENCIES_RATE_UPDATE = 'Currencies Rate Update';

    public function __construct(private EmailRepositoryInterface $emailRepository)
    {
    }

    public function __invoke(Currencies $currencies): void
    {
        $body = 'Se han actualizado las siguientes monedas: ';
        foreach ($currencies->all() as $currency) {
            $body .= $currency->code->value() . ' -> ' . $currency->rateUsd->value() . ' USD' . ' | ';
        }

        $this->emailRepository->sendEmail(
            self::EMAIL_A_NOTIFICAR,
            self::MESSAGE_CURRENCIES_RATE_UPDATE,
            $body
        );
    }
}
