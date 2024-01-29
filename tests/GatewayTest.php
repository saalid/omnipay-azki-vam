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
        $this->gateway->setFallBackUrl('https://www.example.com/return');
        $this->gateway->getMerchantId("123213");
    }

    public function testPurchaseSuccess(): void
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $amount = 60;
        $customerPhone = '09056619083';
        $items = [
            [
                "name" => "کالای شماره 1",
                "count" => 6,
                "amount" => 10,
                "url" => "https://merchant-website/items/1",
            ]
        ];
        $subUrl = '/payment/purchase';

        $response = $this->gateway->purchase([
            'subUrl' => $subUrl,
            'amount' => $amount,
            'customerPhone' => $customerPhone,
            'items' => $items,
        ])->send();
        $responseData = $response->getData();
        self::assertTrue($response->isSuccessful());
        self::assertTrue($response->isRedirect());
//        self::assertEquals('2c3c1fefac5a48geb9f9be7e445dd9b2',$responseData['token']);
//        self::assertEquals('https://sep.shaparak.ir/OnlinePG/SendToken?token=2c3c1fefac5a48geb9f9be7e445dd9b2', $response->getRedirectUrl());
    }

}