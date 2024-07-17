<?php

namespace Hoyvoy\Currencies\Infrastructure\Email;

use Illuminate\Support\Facades\Mail;
use Hoyvoy\Currencies\Domain\Interface\EmailRepositoryInterface;

class EmailRepository implements EmailRepositoryInterface
{

    public function sendEmail(string $to, string $from, string $subject, string $body): void
    {
        Mail::send([], [], function ($message) use ($to, $from, $subject, $body) {
            $message->to($to)
//                ->from($from)
                ->subject($subject)
                ->html($body);
        });
    }
}
