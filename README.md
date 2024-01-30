## Instalation

    composer require amirreza/omnipay-azki-vam

## Example

###### Purchase

#### The result will be a redirect to the gateway or bank.

```php
    $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    $amount = 60;
    $customerPhone = '09xxxxxxxxx';
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
        'subUrl' => '/payment/purchase',
        'amount' => $amount,
        'customerPhone' => $customerPhone,
        'items' => $items,
    ])->send();
    if ($response->isSuccessful() && $response->isRedirect()) {
    // store the transaction reference to use in completePurchase()
    $transactionReference = $response->getTransactionReference();
    // Redirect to offsite payment gateway
    $response->redirect();
    } else {
        // Payment failed: display message to customer
        echo $response->getMessage();
    }

```
### Complete Purchase (Verify)

```php
// Send purchase complete request
    $param= [
        'subUrl' => '/payment/verify',
        'ticketId' => 'PJQPHFwN1AM6EUAJ',
    ];
    $response = $this->gateway->completePurchase($param)->send();
    
    if (!$response->isSuccessful() || $response->isCancelled()) {
        // Payment failed: display message to customer
        echo $response->getMessage();
    } else {
        // Payment was successful
        print_r($response);
    }
```

### Refund Order

Refund an order by the $refNum:

```php
    $param= [
        'subUrl' => '/payment/reverse',
        'ticketId' => 'PJQPHFwN1AM6EUAJ',
    ];
    /** @var ReverseTicketResponse $response */
    $response = $this->gateway->refund($param)->send();
    
    if ($response->isSuccessful()) {
        // Refund was successful
        print_r($response);
    } else {
        // Refund failed
        echo $response->getMessage();
    }
```