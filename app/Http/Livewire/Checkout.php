<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\CartManager;
use App\Product;

class Checkout extends Component
{
    public $products;
    private $cart;

    protected $listeners = ['addToCart'];

    public function mount(CartManager $cart)
    {
        $this->cart = $cart->getCart();
        $this->products = $this->cart->products;
    }

    public function deleteProduct($productId)
    {
        $this->cart->removeProduct($productId);
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
