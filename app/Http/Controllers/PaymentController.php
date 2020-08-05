<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paypal;
use App\CartManager;
use App\Order;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function paypalPaymentRequest(Request $request, CartManager $cart, Paypal $paypal)
    {
        $link = $paypal->paymentRequest($cart->getCart()->amount());
        return redirect()->away($link);
    }

    public function paypalCheckout(Request $request, CartManager $cart, Paypal $paypal, $status)
    {
        if($status == "success") {
            $response = $paypal->checkout($request);
            
            if(!is_null($response)) {
                $response->shopping_cart_id = $cart->getCart()->id;
                Order::createFromResponse($response);
                session()->flash('message','Compra exitosa, hemos enviado un correo con un resument de tu compra');
                return redirect()->route('welcome');
            }
        }
    }

    public function stripeCheckout(Request $request, CartManager $cart)
    {
        // 4242 4242 4242 4242
        Stripe::setApiKey(config('services.stripe.secret'));

        Charge::create([
            'amount' => ($cart->getCart()->amount()) * 100,
            'currency' => 'usd' ,
            'source' => $request->stripeToken
        ]);

        Order::create(['shopping_cart_id' => $cart->getCart()->id, 'email' => $request->email]);
        session()->flash('message','Compra exitosa, hemos enviado un correo con un resument de tu compra');
        return redirect()->route('welcome');
    }
}
