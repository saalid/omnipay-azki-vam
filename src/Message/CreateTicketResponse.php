<?php

/**
 * @package Omnipay\AzkiVam
 * @author Amirreza Salari <amirrezasalari1997@gmail.com>
 */

namespace Omnipay\AzkiVam\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class CreateTicketResponse extends AbstractResponse implements RedirectResponseInterface
{

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return (int)$this->getHttpStatus() === 200 && (int)$this->getCode() === -1;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return (int)$this->getCode() === -1 &&
            isset($this->data['ticket_id']) &&
            !empty($this->data['ticket_id']);
    }

    /**
     * @inheritDoc
     */
    public function getRedirectUrl()
    {
        /** @var CreateTicketRequest $request */
        $request = $this->request;
        return sprintf('%s/payment/%s', $request->getEndpoint(), $this->getTransactionReference());
    }

    /**
     * @inheritDoc
     */
    public function getTransactionId()
    {
        /** @var CreateTicketRequest $request */
        $request = $this->request;
        return $request->getTransactionId();
    }

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return $this->data['ticket_id'];
    }
}