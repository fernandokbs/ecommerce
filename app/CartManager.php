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

    public function removeProduct($pivotId)
    {
        return $this->getCart()->products()->wherePivot('id', $pivotId)->detach();
    }

    public function getCart()
    {
        return $this->findOrCreate($this->findSession());
    }

    private function findOrCreate($cartId = null)
    {
        $cart = null;
        if(is_null($cartId)) 
            $cart = ShoppingCart::create();
        else {
            $cart = ShoppingCart::find($cartId);
            if(is_null($cart))
                $cart = ShoppingCart::create();
        }

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