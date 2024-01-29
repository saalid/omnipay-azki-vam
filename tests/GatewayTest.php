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
    }

    public function testPurchaseSuccess(): void
    {
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
        $responseData=$response->getData();
        self::assertTrue($response->isSuccessful());
        self::assertTrue($response->isRedirect());
        self::assertEquals('2c3c1fefac5a48geb9f9be7e445dd9b2',$responseData['token']);
        self::assertEquals('https://sep.shaparak.ir/OnlinePG/SendToken?token=2c3c1fefac5a48geb9f9be7e445dd9b2', $response->getRedirectUrl());
    }

}