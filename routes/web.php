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
Route::livewire('/checkout', 'checkout')->name('checkout');

// Paypal
Route::get('/paypal/payment', 'PaypalController@paymentRequest')->name('paypal.payment');
Route::get('/paypal/checkout/{status}', 'PaypalController@checkout')->name('paypal.checkout');