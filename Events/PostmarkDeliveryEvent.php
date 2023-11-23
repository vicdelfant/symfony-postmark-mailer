<?php

namespace Symfony\Component\Mailer\Bridge\Postmark\Events;

use Symfony\Component\Mime\Header\Headers;

class PostmarkDeliveryEvent
{
    public const CODE_INACTIVE_RECIPIENT = 406;

    /**
     * @var int
     */
    private $errorCode;

    /**
     * @var Headers
     */
    private $headers;

    /**
     * @var string|null
     */
    private $message;

    public function __construct(string $message, int $errorCode)
    {
        $this->message = $message;
        $this->errorCode = $errorCode;

        $this->headers = new Headers();
    }

    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    public function getHeaders(): Headers
    {
        return $this->headers;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getMessageId(): ?string
    {
        if (!$this->headers->has('Message-ID')) {
            return null;
        }

        return $this->headers->get('Message-ID')->getBodyAsString();
    }

    public function setHeaders(Headers $headers): self
    {
        $this->headers = $headers;

        return $this;
    }
}
