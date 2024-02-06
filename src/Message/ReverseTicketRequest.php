<?php

namespace Omnipay\Azkivam\Message;

class ReverseTicketRequest extends AbstractRequest
{

    protected $endPoint = '/payment/reverse';
    protected function getHttpMethod()
    {
        return 'POST';
    }

    protected function createUri(string $baseUrl)
    {
        return $baseUrl . $this->endPoint;
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