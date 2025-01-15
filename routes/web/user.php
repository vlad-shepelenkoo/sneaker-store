<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\DetailController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\ShopController;

Route::middleware('auth')->name('user.')->group(function(){

    //Dashboard
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('index');
    
    //Orders
    Route::get('/account-orders', [OrderController::class, 'orders'])->name('orders');
    Route::get('/account-order/{order_id}/details', [OrderController::class, 'order_details'])->name('order.details');
    Route::put('/account-order/cancel-order', [OrderController::class, 'order_cancel'])->name('order.cancel');

    //Address
    Route::get('/account-address', [AddressController::class, 'addresses'])->name('addresses');
    Route::get('/account-address/add', [AddressController::class, 'address_add'])->name('address.add');
    Route::post('/account-address/store', [AddressController::class, 'address_store'])->name('address.store');
    Route::get('/account-address/edit/{id}', [AddressController::class, 'address_edit'])->name('address.edit');
    Route::put('/account-address/update', [AddressController::class, 'address_update'])->name('address.update');

    //Details
    Route::get('/account-details', [DetailController::class, 'details'])->name('account.details');
    Route::put('/account-details/update', [DetailController::class, 'details_update'])->name('account.details.update');

    //Wishlist
    Route::get('/account-wishlist', [UserController::class, 'wishlist'])->name('account.wishlist');

    //Reviews
    Route::post('/review/add', [ShopController::class, 'add_review'])->name('review.add');
});