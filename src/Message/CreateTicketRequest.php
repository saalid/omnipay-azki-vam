<?php

/**
 * @package Omnipay\AzkiVam
 * @author Amirreza Salari <amirrezasalari1997@gmail.com>
 */

namespace Omnipay\AzkiVam\Message;

class CreateTicketRequest extends AbstractRequest
{

    protected function getHttpMethod()
    {
        return 'POST';
    }

    protected function createUri(string $endpoint)
    {
        return $endpoint . '/payment/purchase';
    }

    protected function createResponse(array $data)
    {
        return new CreateTicketResponse($this, $data);
    }

    public function getData()
    {
        // TODO: Implement getData() method.
    }
}