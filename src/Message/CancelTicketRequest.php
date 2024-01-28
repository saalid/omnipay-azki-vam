<?php

namespace Omnipay\AzkiVam\Message;

class CancelTicketRequest extends AbstractRequest
{

    protected function getHttpMethod()
    {
        return 'POST';
    }

    protected function createUri(string $endpoint)
    {
        return $endpoint . '/payment/cancel';
    }

    protected function createResponse(array $data)
    {
        return new CancelTicketResponse($this, $data);
    }

    public function getData()
    {
        return [
            "ticket_id" => $this->getTicketId()
        ];
    }
}