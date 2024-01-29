<?php

namespace Omnipay\AzkiVam\Message;

class StatusTicketRequest extends AbstractRequest
{

    protected function getHttpMethod()
    {
        return 'POST';
    }

    protected function createUri(string $endpoint)
    {
        return $endpoint . '/payment/status';
    }

    protected function createResponse(array $data)
    {
        return new StatusTicketResponse($this, $data);
    }

    public function getData()
    {
        return [
            'ticket_id' => $this->getTicketId()
        ];
    }
}