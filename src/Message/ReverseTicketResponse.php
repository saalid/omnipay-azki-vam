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
    public function isCancelled()
    {
        return $this->getHttpStatus() === 200 && $this->getCode() !== 0;
    }
}