<?php

namespace App;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use App\CartManager;

class Paypal
{
    private $client;

    public function __construct()
    {
        $this->client = new PayPalHttpClient(
            new SandboxEnvironment(config('services.paypal.client'), config('services.paypal.secret'))
        );
    }

    public function paymentRequest($amount)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => "test_ref_id1",
                "amount" => [
                    "value" => $amount,
                    "currency_code" => "USD"
                ]
            ]],
            "application_context" => [
                 "cancel_url" => route('paypal.checkout', ['status' => 'failure']),
                 "return_url" => route('paypal.checkout', ['status' => 'success'])
            ] 
        ];

        try {
            $response = $this->client->execute($request);
            $approvalUrl = null;

            foreach($response->result->links as $link)
            {
                if($link->rel === "approve")
                    $approvalUrl = $link->href;
            }

            return $approvalUrl;
        } catch (HttpException $ex) {
          dd($ex);
        }
    }

    public function checkout($request)
    {
        /* 
        PayPalHttp\HttpResponse {#366 ▼
   +statusCode: 201
  +result: {#347 ▼
    +"id": "00B18583CT306792J"
    +"intent": "CAPTURE"
    +"purchase_units": array:1 [▶]
    +"payer": {#363 ▼
      +"name": {#362 ▶}
      +"email_address": "neowork-test-1@gmail.com"
      +"payer_id": "F4K2ZUFMCSHSN"
      +"address": {#364 ▼
        +"country_code": "MX"
      }
    }
    +"create_time": "2020-08-03T20:36:04Z"
    +"update_time": "2020-08-03T20:40:15Z"
    +"links": array:1 [▼
      0 => {#365 ▼
        +"href": "https://api.sandbox.paypal.com/v2/checkout/orders/00B18583CT306792J"
        +"rel": "self"
        +"method": "GET"
      }
    ]
    +"status": "COMPLETED"
  }
  +headers: array:6 [▼
    "" => ""
    "Cache-Control" => "max-age=0, no-cache, no-store, must-revalidate"
    "Content-Length" => "1751"
    "Content-Type" => "application/json"
    "Date" => "Mon, 03 Aug 2020 20"
    "Paypal-Debug-Id" => "56ba3ce9e372c"
  ]
}
*/
        $request = new OrdersCaptureRequest($request->token);
        $request->prefer('return=representation');

        try {
            $response = $this->client->execute($request);
            return $response;
        }catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }

        return null;
    }
}