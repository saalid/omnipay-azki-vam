<?php

namespace Omnipay\AzkiVam\Tests;

use Omnipay\AzkiVam\Gateway;
use Omnipay\AzkiVam\Message\AbstractResponse;
use Omnipay\AzkiVam\Message\CancelTicketResponse;
use Omnipay\AzkiVam\Message\CreateTicketResponse;
use Omnipay\AzkiVam\Message\ReverseTicketRequest;
use Omnipay\AzkiVam\Message\ReverseTicketResponse;
use Omnipay\AzkiVam\Message\StatusTicketResponse;
use Omnipay\AzkiVam\Message\VerifyTicketResponse;
use Omnipay\Common\Http\Client;
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

        /** @var CreateTicketResponse $response */
        $response = $this->gateway->purchase([
            'amount' => $amount,
            'customerPhone' => $customerPhone,
            'items' => $items,
        ])->send();
        $responseData = $response->getData();
        self::assertTrue($response->isSuccessful());
        self::assertTrue($response->isRedirect());
        self::assertEquals('PJQPHFwN1AM6EUAJ',$responseData['result']['ticket_id']);
        self::assertEquals('https://api.azkiloan.com/payment?ticketId=PJQPHFwN1AM6EUAJ',$responseData['result']['payment_uri']);
        self::assertEquals('https://api.azkiloan.com/payment?ticketId=PJQPHFwN1AM6EUAJ', $response->getRedirectUrl());
    }

    public function testPurchaseFailure(): void
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');

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

        /** @var CreateTicketResponse $response */
        $response = $this->gateway->purchase([
            'amount' => $amount,
            'customerPhone' => $customerPhone,
            'items' => $items,
        ])->send();
        $responseData=$response->getData();
        self::assertFalse($response->isSuccessful());
        self::assertFalse($response->isRedirect());
        self::assertEquals(18, $responseData['rsCode']);
        self::assertEquals("Signature Invalid", $responseData['message']);
    }

    public function testCompletePurchaseSuccess(): void
    {
        $this->setMockHttpResponse('PurchaseCompleteSuccess.txt');
        $param= [
            'ticketId' => 'PJQPHFwN1AM6EUAJ',
        ];


        /** @var VerifyTicketResponse $response */
        $response = $this->gateway->completePurchase($param)->send();

        $responseData=$response->getData();

        self::assertTrue($response->isSuccessful());
        self::assertTrue($response->isVerified());
        self::assertEquals('PJQPHFwN1AM6EUAJ',$responseData['result']['ticket_id']);
    }

    public  function testPurchaseCreatedStatus(): void
    {
        $this->setMockHttpResponse('PurchaseCreatedStatus.txt');
        $param= [
            'ticketId' => 'PJQPHFwN1AM6EUAJ',
        ];
        /** @var StatusTicketResponse $response */
        $response = $this->gateway->status($param)->send();

        $responseData=$response->getData();

        self::assertTrue($response->isSuccessful());
        self::assertTrue($response->isCreated());
        self::assertEquals('PJQPHFwN1AM6EUAJ',$responseData['result']['ticket_id']);
    }

    public  function testPurchaseExpiredStatus(): void
    {
        $this->setMockHttpResponse('PurchaseExpiredStatus.txt');
        $param= [
            'ticketId' => 'PJQPHFwN1AM6EUAJ',
        ];
        /** @var StatusTicketResponse $response */
        $response = $this->gateway->statusPurchase($param)->send();

        $responseData=$response->getData();

        self::assertTrue($response->isSuccessful());
        self::assertTrue($response->isExpired());
        self::assertEquals('PJQPHFwN1AM6EUAJ',$responseData['result']['ticket_id']);
    }

    public  function testPurchaseCancel(): void
    {
        $this->setMockHttpResponse('PurchaseCancel.txt');
        $param= [
            'ticketId' => 'PJQPHFwN1AM6EUAJ',
        ];
        /** @var CancelTicketResponse $response */
        $response = $this->gateway->cancel($param)->send();

        $responseData=$response->getData();

        self::assertTrue($response->isSuccessful());
        self::assertEquals($response->getFallBackUrl(),$responseData['result']['fallbackUri']);
    }


}