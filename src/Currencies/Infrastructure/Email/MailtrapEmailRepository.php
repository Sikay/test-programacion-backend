<?php

namespace Hoyvoy\Currencies\Infrastructure\Email;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Hoyvoy\Currencies\Domain\DTO\EmailDTO;
use Hoyvoy\Currencies\Domain\Exception\EmailException;
use Hoyvoy\Currencies\Domain\Interface\EmailRepositoryInterface;

class MailtrapEmailRepository implements EmailRepositoryInterface
{
    public function __construct(
        protected Client $client
    ) {
    }

    public function sendEmail(EmailDTO $emailDTO): void
    {
        try {

            $url = 'https://sandbox.api.mailtrap.io/api/send/3027041';
            $data = [
                "from" => [
                    "email" => config('mail.from.address'),
                ],
                "to" => [
                    ["email" => $emailDTO->to]
                ],
                "subject" => $emailDTO->subject,
                "text" => $emailDTO->body,
            ];

            $this->client->request('POST', $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('MAILTRAP_API_KEY'),
                ],
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            throw new EmailException();
        }
    }
}
