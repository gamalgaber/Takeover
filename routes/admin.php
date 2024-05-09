<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\HomePageSettings;
use App\Http\Controllers\Backend\LoadingPhotoController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\SaleController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\TransactionController;
use Illuminate\Support\Facades\Route;


/**Admin Routes*/
Route::get('dashboard', [AdminController::class,'dashboard'])->name('dashboard');
Route::get('profile', [AdminController::class, 'profile'])->name('profile');
Route::post('profile', [AdminController::class, 'updateAdminProfile'])->name('profile.update');
Route::put('profile', [AdminController::class, 'updateAdminPassword'])->name('password.update');

/** Loading Photo Routes */
Route::put('loadingPhoto/change-status', [LoadingPhotoController::class, 'changeStatus'])->name('Loading-photo.change-status');
Route::resource('Loading-photo',LoadingPhotoController::class);

/** Category Routes */
Route::put('category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

/** Product Routes */
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('products.change-status');
Route::resource('products', ProductController::class);


/** Products Gallery Routes */
Route::resource('product-image-gallery', ProductImageGalleryController::class);

/** Products Variants Routes */
Route::put('product-variants/change-status', [ProductVariantController::class, 'changeStatus'])->name('product-variants.change-status');
Route::resource('product-variants', ProductVariantController::class);


/** Product Variant Item Routes */
Route::get('product-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('product-variant-item.index');

Route::get('product-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('product-variant-item.create');

Route::post('product-variant-item', [ProductVariantItemController::class, 'store'])->name('product-variant-item.store');

Route::get('product-variant-item-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('product-variant-item.edit');

Route::put('product-variant-item-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('product-variant-item.update');

Route::delete('product-variant-item/{variantId}', [ProductVariantItemController::class, 'destroy'])->name('product-variant-item.destroy');

Route::put('product-variant-item-status', [ProductVariantItemController::class, 'changeStatus'])->name('product-variant-item.change-status');


/**Sale Routes */
Route::get('sale', [SaleController::class, 'index'])->name('sale.index');
Route::put('sale', [SaleController::class, 'update'])->name('sale.update');
Route::post('sale/add-product', [SaleController::class, 'addProduct'])->name('sale.add-product');
Route::put('sale/change-status', [SaleController::class, 'changeStatus'])->name('sale.change-status');
Route::put('flash-sale/show-at-home', [SaleController::class, 'changeShowAtHome'])->name('sale.show-at-home');
Route::delete('sale/{id}', [SaleController::class, 'destroy'])->name('sale.destroy');

/** Coupon Routes */
Route::put('coupon/change-status', [CouponController::class, 'changeStatus'])->name('coupon.change-status');
Route::resource('coupon', CouponController::class);

/** Shipping Routes */
Route::put('shipping/change-status', [ShippingController::class, 'changeStatus'])->name('shipping.change-status');
Route::resource('shipping', ShippingController::class);

/** Home Page Settings Route */
Route::get('home-page-settings', [HomePageSettings::class, 'index'])->name('home-page-settings');
Route::get('home-page-settings/edit/{id}', [HomePageSettings::class, 'edit'])->name('home-page-settings.edit');
Route::put('home-page-settings/update/{id}', [HomePageSettings::class, 'update'])->name('home-page-settings.update');


/** order Routes */
Route::get('order', [OrderController::class, 'index'])->name('order');
Route::delete('order/{id}', [OrderController::class, 'destroy'])->name('order.delete');
Route::get('order-bill/{id}', [OrderController::class, 'getBill'])->name('order.bill');


/** Transaction Routes */
Route::get('transaction', [TransactionController::class, 'index'])->name('transaction');

