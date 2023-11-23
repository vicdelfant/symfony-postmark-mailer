<?php

namespace Symfony\Component\Mailer\Bridge\Postmark\Events;

use Symfony\Component\Mime\Header\Headers;

class PostmarkDeliveryEvent
{
    public const CODE_INACTIVE_RECIPIENT = 406;

    /**
     * @var int
     */
    public $errorCode;

    /**
     * @var Headers
     */
    public $headers;

    /**
     * @var string|null
     */
    public $message;

    /**
     * @var string|null
     */
    public $messageId;

    public function __construct(string $message, int $errorCode)
    {
        $this->message = $message;
        $this->errorCode = $errorCode;

        $this->headers = new Headers();
        $this->messageId = null;
    }

    public function setHeaders(Headers $headers): self
    {
        $this->headers = $headers;

        // With the Message-ID being the unique reference to an e-mail, we keep it in a separate property for convenience
        if ($headers->has('Message-ID')) {
            $this->messageId = $headers->get('Message-ID')->getBodyAsString();
        }

        return $this;
    }
}
