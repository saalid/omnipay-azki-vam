<?php

namespace Omnipay\AzkiVam\Tests;

use Omnipay\AzkiVam\Gateway;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /**
     * @var Gateway
     */
    protected $gateway;

    /**
     * @var array<string, integer|string|boolean>
     */
    protected $params;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->gateway->setApiKey('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx');
        $this->gateway->setRedirectUrl('https://www.example.com/return');
    }
}