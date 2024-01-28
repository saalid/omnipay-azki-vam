<?php

namespace Omnipay\AzkiVam\Message;

class VerifyTicketResponse extends AbstractResponse
{


    /**
     * @inheritDoc
     */
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