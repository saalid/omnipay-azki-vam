<?php

/**
 * @package Omnipay\AzkiVam
 * @author Amirreza Salari <amirrezasalari1997@gmail.com>
 */

namespace Omnipay\AzkiVam\Message;

use Exception;
use RuntimeException;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Class AbstractRequest
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * Live Endpoint URL
     *
     * @var string URL
     */
    protected $liveEndpoint = 'https://api.azkiloan.com';

    /**
     * @return string
     */
    abstract protected function getHttpMethod();

    /**
     * @param string $endpoint
     * @return string
     */
    abstract protected function createUri(string $endpoint);

    /**
     * @param array $data
     * @return AbstractResponse
     */
    abstract protected function createResponse(array $data);

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->getParameter('apiKey');
    }

    public function getMerchantId(): string
    {
        return $this->getParameter('merchantId');
    }

    public function getFallBackUrl(): string
    {
        return $this->getParameter('fallBackUrl');
    }
    /**
     * @return string|null
     */

    /**
     * @param string $value
     * @return self
     */
    public function setApiKey(string $value): self
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * @param string $value
     * @return self
     */
    public function setMerchantId(string $value): self
    {
        return $this->setParameter('merchantId', $value);
    }


    public function setFallBackUrl(string $fallBackUrl): self
    {
        return $this->setParameter('fallBackUrl', $fallBackUrl);
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        if ($this->getTestMode()) {
            throw new \InvalidArgumentException('Nextpay payment gateway does not support test mode.');
        }
        return $this->liveEndpoint;
    }

    public function createSignature() :string
    {
        return $this->getSubUrl().'#'.time().'#'.$this->getHttpMethod().'#'.$this->getApiKey();
    }

    public function getTicketId() :string
    {
        return $this->getParameter('ticketId');
    }

    public function setTicketId(int $ticketId): self
    {
        return $this->setParameter('ticketId', json_encode($ticketId));
    }

    public function getRedirectUrl() :string
    {
        return $this->getParameter('redirectUrl');
    }

    public function setRedirectUrl(string $redirectUrl): self
    {
        return $this->setParameter('redirectUrl', $redirectUrl);
    }

    public function getSubUrl(): string
    {
        return $this->getParameter('subUrl');
    }

    public function setSubUrl(string $subUrl): self
    {
        return $this->setParameter('subUrl', $subUrl);
    }


    /**
     * Send the request with specified data
     *
     * @param mixed $data The data to send.
     * @return ResponseInterface
     * @throws RuntimeException
     * @throws InvalidResponseException
     */
    public function sendData($data)
    {
        try {
            $body = json_encode($data);

            if ($body === false) {
                throw new RuntimeException('Err in access/refresh token.');
            }
            $httpResponse = $this->httpClient->request(
                $this->getHttpMethod(),
                $this->createUri($this->getEndpoint()),
                [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json',
                    'signature' => $this->createSignature(),
                    'merchantId' => $this->getMerchantId()
                ],
                $body
            );
            $json = $httpResponse->getBody()->getContents();
            $result = !empty($json) ? json_decode($json, true) : [];
            $result['httpStatus'] = $httpResponse->getStatusCode();
            return $this->response = $this->createResponse($result);
        } catch (Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }
}