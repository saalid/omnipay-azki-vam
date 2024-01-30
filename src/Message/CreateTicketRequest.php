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

    public function getCustomerPhone(): ?string
    {
        return $this->getParameter('customerPhone');
    }

    /**
     * @param string $customerPhone
     * @return self
     */
    public function setCustomerPhone(string $customerPhone): self
    {
        return $this->setParameter('customerPhone', $customerPhone);
    }

    public function setItems($items): self
    {
        return $this->setParameter('items', $items);
    }



    public function getData()
    {
        return [
            "amount" => $this->getAmount(),
            "redirect_uri" => $this->getRedirectUrl(),
            "fallback_uri" =>  $this->getFallBackUrl(),
            "provider_id" => $this->createProviderId(),
            "mobile_number" => $this->getCustomerPhone(),
            "merchant_id" => $this->getMerchantId(),
            "items" => $this->getItems()
        ];
    }
}