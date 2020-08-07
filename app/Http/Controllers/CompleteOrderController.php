<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class CompleteOrderController extends Controller
{
    public function completeForm(Request $request, Order $order)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }
    
        return view('complete', compact('order'));
    }

    public function completeOrder(Request $request, Order $order)
    {

    }
}
