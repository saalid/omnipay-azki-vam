<?php

namespace Omnipay\Azkivam\Message;

use Omnipay\Common\Exception\InvalidRequestException;
class StatusTicketRequest extends AbstractRequest
{

    protected $endPoint = '/payment/status';
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