<?php


namespace Omnipay\AzkiVam;

use Omnipay\AzkiVam\Message\CreateTicketRequest;
use Omnipay\AzkiVam\Message\ReverseTicketRequest;
use Omnipay\AzkiVam\Message\VerifyTicketRequest;
use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{

    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     * @return string
     */
    public function getName(): string
    {
        return 'AzkiVam';
    }

    /**
     * @return array
     */
    public function getDefaultParameters(): array
    {
        return [
            'apiKey' => 'xxxxxxx-xxxxx',
            'redirectUrl' => 'https://test1.com/redirect',
            'fallBackUrl' => 'https://test1.com/failed',
            'merchantId' => '1234213213'
        ];
    }

    /**
     * @inheritDoc
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function purchase(array $options = [])
    {
        return $this->createRequest(CreateTicketRequest::class, $options);
    }

    /**
     * @inheritDoc
     */
    public function completePurchase(array $options = [])
    {
        return $this->createRequest(VerifyTicketRequest::class, $options);
    }

    /**
     * @inheritDoc
     */
    public function refund(array $options = [])
    {
        return $this->createRequest(ReverseTicketRequest::class, $options);
    }

    /**
     * Return the key of transaction reference in returned responses of the gateway
     * @return string
     */
    public function getTransactionReferenceKey(): string
    {
        return 'ticket_id';
    }
}