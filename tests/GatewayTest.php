<?php

namespace Omnipay\AzkiVam\Tests;

use Omnipay\AzkiVam\Gateway;
use Omnipay\Tests\GatewayTestCase;
use Omnipay\Omnipay;

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

        $this->gateway = Omnipay::create('AzkiVam');
        $this->gateway->setApiKey('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx');
        $this->gateway->setRedirectUrl('https://www.example.com/return');
    }

    public function testPurchaseSuccess(): void
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');


        $paramValue= [
            "amount" => 90,
            "redirect_uri" => 'https://asddasd.com/asd',
            "fallback_uri" => 'https:/test.com/failed',
            "provider_id" => 123213213,
            "mobile_number" => '09056619083',
            "merchant_id" => 213213,
            "items" => [
                [
                    "name" => "کالای شماره ۱",
                    "count" => 3,
                    "amount" => 15,
                    "url" => "https://merchant-website/items/1",
                ],
                [
                    "name" => "کالای شماره ۲",
                    "count" => 3,
                    "amount" => 15,
                    "url" => "https://merchant-website/items/2",
                ]
            ],
        ];

        $response = $this->gateway->purchase($paramValue)->send();
        $responseData=$response->getData();
        self::assertTrue($response->isSuccessful());
        self::assertTrue($response->isRedirect());
        self::assertEquals('2c3c1fefac5a48geb9f9be7e445dd9b2',$responseData['token']);
        self::assertEquals('https://sep.shaparak.ir/OnlinePG/SendToken?token=2c3c1fefac5a48geb9f9be7e445dd9b2', $response->getRedirectUrl());
    }

}