<?php

namespace Omnipay\AzkiVam\Message;

class CancelTicketResponse extends AbstractResponse
{

    public function isSuccessful()
    {
        return (int)$this->getHttpStatus() === 200 && (int)$this->getCode() === 0;
    }

    public function getFallBackUrl()
    {
        return $this->data['result']['fallbackUri'];
    }
}