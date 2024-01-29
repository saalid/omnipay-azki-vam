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
        return $endpoint . $this->getSubUrl();
    }

    protected function createResponse(array $data)
    {
        return new CreateTicketResponse($this, $data);
    }

    public function getSubUrl(): string
    {
        return $this->getParameter('subUrl');
    }

    public function setSubUrl(string $subUrl): self
    {
        return $this->setParameter('subUrl', $subUrl);
    }

    public function getData()
    {
        return [
            "amount" => $this->getAmount(),
            "redirect_uri" => $this->getReturnUrl(),
            "fallback_uri" => $this->getFallBackUrl(),
            "provider_id" => $this->getProviderId(),
            "mobile_number" => $this->getCustomerPhone(),
            "merchant_id" => $this->getMerchantId(),
            "items" => $this->getItems(),
        ];
    }
}