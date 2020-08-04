<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paypal;
use App\CartManager;
use App\Order;

class PaypalController extends Controller
{
    private $paypal, $cart;

    public function __construct(Paypal $paypal) {
        $this->paypal = $paypal;
    }

    public function paymentRequest(Request $request, CartManager $cart)
    {
        $link = $this->paypal->paymentRequest($cart->getCart()->amount());
        return redirect()->away($link);
    }

    public function checkout(Request $request, CartManager $cart, $status)
    {
        if($status == "success") {
            $response = $this->paypal->checkout($request);
            
            if(!is_null($response)) {
                $response->shopping_cart_id = $cart->getCart()->id;
                Order::createFromResponse($response);
                session()->flash('message','Compra exitosa, hemos enviado un correo con un resument de tu compra');
                return redirect()->route('welcome');
            }
        }
    }
}
