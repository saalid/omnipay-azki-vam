<?php

/**
 * @package Omnipay\Azkivam
 * @author Amirreza Salari <amirrezasalari1997@gmail.com>
 */

namespace Omnipay\Azkivam\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class CreateTicketResponse extends AbstractResponse implements RedirectResponseInterface
{

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return (int)$this->getHttpStatus() === 200 && (int)$this->getCode() === 0;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return (int)$this->getCode() === 0 &&
            isset($this->data['result']['ticket_id']) &&
            !empty($this->data['result']['ticket_id']);
    }

    /**
     * @inheritDoc
     */
    public function getRedirectUrl()
    {
        /** @var CreateTicketRequest $request */
        return $this->data['result']['payment_uri'];
    }

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return $this->data['result']['ticket_id'];
    }
}