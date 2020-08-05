<?php

namespace App;

use App\Product;
use App\ShoppingCart;

class CartManager
{
    private $sessionName = "shopping_card_id";
    
    public function addToCart($productId)
    {
        $cart = $this->findOrCreate($this->findSession());
        $product = $this->getProduct($productId);
        $cart->products()->attach($product->id);
    }

    public function getId()
    {
        return $this->findSession();
    }

    public function getamount()
    {
        return ($this->findOrCreate($this->findSession()))->amount();
    }

    public function deleteSession()
    {
        return request()->session()->forget($this->sessionName);
    }

    public function removeProduct($productId)
    {
        $product = $this->getProduct($productId);
    }

    public function getCart()
    {
        return $this->findOrCreate($this->findSession());
    }

    private function findOrCreate($cartId = null)
    {
        $cart = is_null($cartId) ? ShoppingCart::create() : ShoppingCart::find($cartId);

        if(!request()->session()->has($this->sessionName))
            request()->session()->put($this->sessionName, $cart->id); 
        
        return $cart;
    }

    private function getProduct($slug)
    {
        return Product::where('slug', $slug)->first();
    }

    private function findSession()
    {
        return request()->session()->get($this->sessionName);
    }
}