<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CollectionController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    /** ------------------------------------------Wishlist Routes-------------------------------------- */
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('wishlist/add-product', [WishlistController::class, 'addToWishlist'])->name('wishlist.store');
    Route::get('wishlist/remove-product/{id}',[WishlistController::class,'removeFromWishlist'])->name('wishlist.destroy');
    Route::get('wishlist-count', [WishlistController::class, 'countWishlistItems'])->name('wishlist-count');

});

require __DIR__ . '/auth.php';


/** ----------------------------------------Socialite Login-------------------------------------------- */
Route::get('auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');

/** ---------------------------------------Product Detail----------------------------------------------------------*/
Route::get('product-detail/{slug}', [ProductController::class, 'showProduct'])->name('product-detail');



/** ---------------------------------Cart Routes------------------------- */
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::post('cart/update-quantity', [CartController::class, 'updateProductQuantity'])->name('cart.update-quantity');
Route::get('cart/clear-cart', [CartController::class, 'clearCart'])->name('cart.clear-cart');
Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('cart.remove-product');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart.cart-count');
Route::get('cart/products', [CartController::class, 'cartTotal'])->name('cart.product-total');


/**-----------------------------------------------Contact Routes------------------------------------------------------- */
Route::get('contact', [ContactController::class, 'contact'])->name('contact');
Route::post('contact', [ContactController::class, 'handleContactForm'])->name('handle-contact-form');


/**-----------------------------------------------Checkout Routes------------------------------------ */
Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::get('checkout/buyNow/{product_id}', [CheckoutController::class, 'buyNow'])->name('checkout.buyNow');
Route::get('checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.apply-coupon');
Route::get('checkout-calculation', [CheckoutController::class, 'couponCalculation'])->name('checkout.coupon-calculation');
Route::post('checkout/form-submit', [CheckoutController::class, 'checkoutFormSubmit'])->name('checkout.form-submit');
Route::get('checkout/calculate-shipping-cost', [CheckoutController::class, 'calculateShippingCost'])->name('calculate-shipping-cost');

/**-----------------------------------------------Collections Routes------------------------------------ */
Route::get('collections', [CollectionController::class, 'index'])->name('collections');

Route::fallback(function () {
    return view('frontend.pages.error404');
});
