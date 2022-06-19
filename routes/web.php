<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!|
*/


Auth::routes();

Route::get('orders/history', [\App\Http\Controllers\OrderController::class,'history'])
->middleware(['auth'])
->name('orders.history');

Route::resource('orders', \App\Http\Controllers\OrderController::class)
->middleware([
    'auth',
    'admin',
]);
Route::get('order/{order}', [App\Http\Controllers\OrderController::class, 'show'])
->name('order.show');


Route::resource('users',\App\Http\Controllers\UserController::class)->middleware([
  'auth',
  'admin',
]);

Route::resource('products', App\Http\Controllers\ProductController::class)
    ->middleware([
        'auth',
        'admin',

    ]);

    Route::get('product/{product}', [App\Http\Controllers\ProductController::class, 'show'])
 ->name('product.show');


Route::resource('typeofpizzas', App\Http\Controllers\TypeofpizzaController::class)
    ->middleware([
        'auth',
        'admin',
    ]);

     Route::get('typeofpizza/{typeofpizza}', [App\Http\Controllers\TypeofpizzaController::class, 'show'])
  ->name('typeofpizza.show');


Route::resource('cart', \App\Http\Controllers\CartController::class)
    ->middleware([
        'auth',
    ]);

    Route::get('/cart/{cart}/checkout', [\App\Http\Controllers\CartController::class,'checkout'])
    ->middleware([
        'auth',
    ])->name('cart.checkout');

    
    Route::post('/cart/{cart}/{order}/update', [\App\Http\Controllers\CartController::class,'updateorder'])
    ->middleware([
        'auth',
    ])->name('cart.order.update');

    Route::post('/cart/{cart}/{order}/complete', [\App\Http\Controllers\CartController::class,'completecheckout'])
    ->middleware([
        'auth',
    ])->name('cart.complete');
 

 Route::get('/contact', function () {
  return view('contact');
})->name('contact');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





