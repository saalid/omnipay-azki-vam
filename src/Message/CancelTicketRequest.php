<?php

namespace Omnipay\AzkiVam\Message;

use Omnipay\Common\Exception\InvalidRequestException;
class CancelTicketRequest extends AbstractRequest
{

    protected $endPoint = '/payment/cancel';

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
        return new CancelTicketResponse($this, $data);
    }

    public function getData()
    {
        $this->validate("ticketId");

        return [
            "ticket_id" => $this->getTicketId()
        ];
    }
}