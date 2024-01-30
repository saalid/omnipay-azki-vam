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

    public function isUnverifiable()
    {
        return $this->getHttpStatus() === 500 && $this->getCode() !== 0;
    }
    public function isCreated()
    {
        return $this->getHttpStatus() === 200 && $this->getStatus() === 1;
    }
    public function isVerified()
    {
        return $this->getHttpStatus() === 200 && $this->getStatus() === 2;
    }
    public function isReversed()
    {
        return $this->getHttpStatus() === 200 && $this->getStatus() === 3;
    }
    public function isFailed()
    {
        return $this->getHttpStatus() === 200 && $this->getStatus() === 4;
    }
    public function isCanceled()
    {
        return $this->getHttpStatus() === 200 && $this->getStatus() === 5;
    }
    public function isSettled()
    {
        return $this->getHttpStatus() === 200 && $this->getStatus() === 6;
    }
    public function isExpired()
    {
        return $this->getHttpStatus() === 200 && $this->getStatus() === 7;
    }
    public function isDone()
    {
        return $this->getHttpStatus() === 200 && $this->getStatus() === 8;
    }



    public function getStatus() :int
    {
        return (int)$this->data['result']['status'] ?? parent::getCode();
    }
}