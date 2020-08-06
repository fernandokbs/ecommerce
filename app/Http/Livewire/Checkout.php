<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\CartManager;
use App\Product;

class Checkout extends Component
{
    public $stripeKey;
    private $cart;

    public function mount(CartManager $cart)
    {
        $this->cart = $cart->getCart();
        $this->stripeKey = config('services.stripe.key');
    }

    public function deleteProduct(CartManager $cart, $pivotId)
    {
        $cart->removeProduct($pivotId);
        $this->emitTo('cart','addToCart');
        session()->flash('message', 'Producto removido');
    }

    public function hydrate()
    {
        $this->cart = (app(CartManager::class))->getCart();
    }

    public function render()
    {
        return view('livewire.checkout', [
            'products' => $this->cart->products
        ]);
    }
}
