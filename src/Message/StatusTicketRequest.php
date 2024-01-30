<?php

namespace Omnipay\AzkiVam\Message;

use Omnipay\Common\Exception\InvalidRequestException;
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
        $this->validate('ticketId');

        return [
            'ticket_id' => $this->getTicketId()
        ];
    }
}