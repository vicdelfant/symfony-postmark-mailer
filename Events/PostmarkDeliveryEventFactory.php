<?php

namespace Symfony\Component\Mailer\Bridge\Postmark\Events;

use Symfony\Component\Mime\Email;

class PostmarkDeliveryEventFactory
{
    public function create($errorCode, string $message, Email $email): PostmarkDeliveryEvent
    {
        if (!$this->supports($errorCode)) {
            throw new \InvalidArgumentException(sprintf('Error code "%s" is not supported.', $errorCode));
        }

        return (new PostmarkDeliveryEvent($message, $errorCode))
            ->setHeaders($email->getHeaders());
    }

    public function supports(int $errorCode): bool
    {
        return in_array($errorCode, [
            PostmarkDeliveryEvent::CODE_INACTIVE_RECIPIENT,
        ]);
    }
}
