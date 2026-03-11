<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;

Route::get('/', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{slug}', [MenuController::class, 'show'])->name('menu.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
// Restore cart dari order yang failed → balik ke checkout
Route::get('/checkout/restore/{orderId}', [CheckoutController::class, 'restoreFromOrder'])->name('checkout.restore');

Route::get('/payment/{orderId}', [PaymentController::class, 'status'])->name('payment.status');
Route::post('/payment/{orderId}/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');
Route::get('/payment/{orderId}/receipt', [PaymentController::class, 'receipt'])->name('payment.receipt');
