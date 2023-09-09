<?php

namespace Symfony\Component\Mailer\Bridge\Postmark\Events;

use Symfony\Component\Mime\Email;

class PostmarkSendErrorFactory
{
    public function generate($errorCode, Email $email): PostmarkSendErrorInterface
    {
    }

    public function supports(int $statusCode): bool
    {
    }
}
