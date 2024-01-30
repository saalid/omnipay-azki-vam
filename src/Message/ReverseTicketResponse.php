<?php

namespace Omnipay\AzkiVam\Message;

class ReverseTicketResponse extends AbstractResponse
{

    public function isSuccessful()
    {
        return $this->getHttpStatus() === 200 && (int)$this->getCode() === 0;
    }

    /**
     * @inheritDoc
     */
    public function notFound()
    {
        return $this->getHttpStatus() === 404 && (int)$this->getCode() === 2;
    }
}