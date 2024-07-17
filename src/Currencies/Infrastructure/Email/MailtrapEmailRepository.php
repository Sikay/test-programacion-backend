<?php

namespace Hoyvoy\Currencies\Infrastructure\Email;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Hoyvoy\Currencies\Domain\Exception\EmailException;
use Hoyvoy\Currencies\Domain\Interface\EmailRepositoryInterface;

class MailtrapEmailRepository implements EmailRepositoryInterface
{
    public function __construct(
        protected Client $client
    ) {
    }

    public function sendEmail(string $to, string $from, string $subject, string $body): void
    {
        try {

            $url = 'https://sandbox.api.mailtrap.io/api/send/3027041';
            $data = [
                "from" => [
                    "email" => config('mail.from.address'),
                ],
                "to" => [
                    ["email" => $to]
                ],
                "subject" => $subject,
                "text" => $body,
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
