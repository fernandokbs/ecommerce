<?php

namespace App\Http\Middleware;

use Closure;
use App\CartManager;

class CheckShoppingCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cart = app(CartManager::class);

        if($cart->getCart()->products->count() == 0)
            return redirect('/');

        return $next($request);
    }
}
