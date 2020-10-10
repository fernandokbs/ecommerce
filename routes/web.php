<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('welcome');
})->name('welcome');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/productos/{product}', [Livewire\Product\Show::class])->name('products.show');
Route::get('/crear', [Livewire\Product\Create::class])->name('products.create')->middleware('admin');
Route::get('/checkout', [Livewire\Checkout::class])->name('checkout')->middleware('check');

// Paypal
Route::get('/paypal/payment', 'PaymentController@paypalPaymentRequest')->name('paypal.payment');
Route::get('/paypal/checkout/{status}', 'PaymentController@paypalCheckout')->name('paypal.checkout');

// Stripe
Route::post('/stripe/checkout', 'PaymentController@stripeCheckout')->name('stripe.checkout');

// Complete
Route::get('/order/complete/{order}', 'CompleteOrderController@completeForm')->name('order.complete');
Route::post('/order/{order}', 'CompleteOrderController@completeOrder')->name('complete');