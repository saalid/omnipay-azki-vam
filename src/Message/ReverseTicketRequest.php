<?php

namespace Omnipay\AzkiVam\Message;

class ReverseTicketRequest extends AbstractRequest
{

    protected function getHttpMethod()
    {
        return 'POST';
    }

    protected function createUri(string $endpoint)
    {
        return $endpoint . '/payment/reverse';
    }

    protected function createResponse(array $data)
    {
        return new ReverseTicketResponse($this, $data);
    }

    public function getData()
    {
        return [
            'ticket_id' => $this->getTicketId(),
            'provider_id' => $this->createProviderId()
        ];
    }
}