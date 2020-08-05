<?php

use Illuminate\Support\Facades\Route;

// 	neowork-test-1@gmail.com

Route::get('/', function() {
    return view('welcome');
})->name('welcome');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::livewire('/productos/{product}', 'product.show')->name('products.show');
Route::livewire('/crear', 'product.create')->name('products.create')->middleware('admin');
Route::livewire('/checkout', 'checkout')->name('checkout')->middleware('check');

// Paypal
Route::get('/paypal/payment', 'PaymentController@paypalPaymentRequest')->name('paypal.payment');
Route::get('/paypal/checkout/{status}', 'PaymentController@paypalCheckout')->name('paypal.checkout');

// Stripe
Route::post('/stripe/checkout', 'PaymentController@stripeCheckout')->name('stripe.checkout');