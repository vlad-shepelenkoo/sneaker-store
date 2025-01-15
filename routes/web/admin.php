<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AuthAdmin;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\UserController;

Auth::routes();

Route::middleware('auth', AuthAdmin::class)->prefix('admin')->name('admin.')->group(function(){
    
    Route::get('/', [AdminController::class, 'index'])->name('index');

    //Brands
    Route::get('/brands', [BrandController::class, 'brands'])->name('brands');
    Route::get('/brand/add', [BrandController::class, 'addBrand'])->name('brand.add');
    Route::post('/brand/store', [BrandController::class, 'brand_store'])->name('brand.store');
    Route::get('/brand/edit/{id}', [BrandController::class, 'brand_edit'])->name('brand.edit');
    Route::put('/brand/update', [BrandController::class, 'brand_update'])->name('brand.update');
    Route::delete('/brand/{id}/delete', [BrandController::class, 'brand_delete'])->name('brand.delete');

    //Categories
    Route::get('/categories', [CategoryController::class, 'categories'])->name('categories');
    Route::get('/categories/add', [CategoryController::class, 'category_add'])->name('category.add');
    Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'category_edit'])->name('category.edit');
    Route::put('/category/update', [CategoryController::class, 'category_update'])->name('category.update');
    Route::delete('/category/{id}/delete', [CategoryController::class, 'category_delete'])->name('category.delete');

    //Products
    Route::get('/products', [ProductController::class, 'products'])->name('products');
    Route::get('/product/add', [ProductController::class, 'product_add'])->name('product.add');
    Route::post('/product/store', [ProductController::class, 'product_store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'product_edit'])->name('product.edit');
    Route::put('/product/update', [ProductController::class, 'product_update'])->name('product.update');
    Route::delete('/product/{id}/delete', [ProductController::class, 'product_delete'])->name('product.delete');

    //Coupons
    Route::get('/coupons', [CouponController::class, 'coupons'])->name('coupons');
    Route::get('/coupon/add', [CouponController::class, 'coupon_add'])->name('coupon.add');
    Route::post('/coupon/store', [CouponController::class, 'coupon_store'])->name('coupon.store');
    Route::get('/coupon/{id}/edit', [CouponController::class, 'coupon_edit'])->name('coupon.edit');
    Route::put('/coupon/update', [CouponController::class, 'coupon_update'])->name('coupon.update');
    Route::delete('/coupon/{id}/delete', [CouponController::class, 'coupon_delete'])->name('coupon.delete');

    //Orders
    Route::get('/orders', [OrderController::class, 'orders'])->name('orders');
    Route::get('/order/{order_id}/details', [OrderController::class, 'order_details'])->name('order.details');
    Route::put('/order/update-status', [OrderController::class, 'update_order_status'])->name('order.status.update');

    //Slides
    Route::get('/slides', [SlideController::class, 'slides'])->name('slides');
    Route::get('/slide/add', [SlideController::class, 'slide_add'])->name('slide.add');
    Route::post('/slide/store', [SlideController::class, 'slide_store'])->name('slide.store');
    Route::get('/slide/{id}/edit', [SlideController::class, 'slide_edit'])->name('slide.edit');
    Route::put('/slide/update', [SlideController::class, 'slide_update'])->name('slide.update');
    Route::delete('/slide/{id}/delete', [SlideController::class, 'slide_delete'])->name('slide.delete');

    //Contacts
    Route::get('/contact', [ContactController::class, 'contacts'])->name('contacts');
    Route::get('/contact-details/{id}', [ContactController::class, 'contact_details'])->name('contact.details');
    Route::put('/contact/update/{id}', [ContactController::class, 'contact_update'])->name('contact.update');
    Route::delete('/contact/{id}/delete', [ContactController::class, 'contact_delete'])->name('contact.delete');

    //Search
    Route::get('/search', [AdminController::class, 'search'])->name('search');

    //Users
    Route::get('/users', [UserController::class, 'users'])->name('users');
    Route::get('/user/{id}/edit', [UserController::class, 'user_edit'])->name('user.edit');
    Route::put('/user/update', [UserController::class, 'user_update'])->name('user.update');

    //Settings
    Route::get('/settings', [SettingController::class, 'settings'])->name('settings');
    Route::put('/settings/update', [SettingController::class, 'settings_update'])->name('settings.update');
});