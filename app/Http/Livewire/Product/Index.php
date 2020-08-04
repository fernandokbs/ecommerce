<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Product;
use App\CartManager; 

class Index extends Component
{
    public function addToCart(CartManager $cart, $productId)
    {
        $cart->addToCart($productId); 
        session()->flash('message', 'Producto agregado al carrito de compras');
        $this->emitTo('cart','addToCart');
    }

    public function render()
    {
        return view('livewire.product.index', [
            'products' =>  Product::all()
        ]);
    }
}
