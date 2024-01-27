<?php


namespace Omnipay\AzkiVam;

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
            'testMode' => false,
            'apiKey' => '',
            'redirectUrl' => '',
            'fallBackUrl' => '',
            'merchantId' => ''
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
     * @return string
     */
    public function getApiKey(): ?string
    {
        return $this->getParameter('apiKey');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setApiKey(string $value): self
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * @return string
     */
    public function getRedirectUrl(): ?string
    {
        return $this->getParameter('redirectUrl');
    }

    public function setRedirectUrl(string $value): self
    {
        return $this->setParameter('redirectUrl', $value);
    }

    public function getFallBackUrl(): ?string
    {
        return $this->getParameter('fallBackUrl');
    }

    public function setFallBackUrl(string $value): self
    {
        return $this->setParameter('fallBackUrl', $value);
    }

    public function getMerchantId(): ?string
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId(string $value): self
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * @inheritDoc
     */
    public function purchase(array $options = [])
    {

    }

    /**
     * @inheritDoc
     */
    public function completePurchase(array $options = [])
    {

    }

    /**
     * @inheritDoc
     */
    public function refund(array $options = [])
    {

    }

    /**
     * Return the key of transaction reference in returned responses of the gateway
     * @return string
     */
    public function getTransactionReferenceKey(): string
    {
        return 'trans_id';
    }
}