<?php

use App\Models\Shipping;
use Illuminate\Support\Facades\Session;

function setActive(array $route)
{
    if (is_array($route)) {
        foreach ($route as $r) {
            if (request()->routeIs($r)) {
                return 'active';
            }
        }
    }
}

function checkProductType(string $type)
{
    switch ($type) {
        case 'new_arrival':
            return 'New';
            break;
        case 'featured_product':
            return 'Featured';
            break;
        case 'top_product':
            return 'Top';
            break;
        case 'sale':
            return 'Sale';
            break;
        default:
            return  '';
            break;
    }
}
function checkDiscount($product)
{
    $currentDate = date('Y-m-d');
    if ($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
        return true;
    }
    return false;
}

function discountPercent($originalPrice, $discountPrice)
{
    $discountAmount = $originalPrice - $discountPrice;
    $discountPercent = ($discountAmount / $originalPrice * 100);
    return (int)$discountPercent;
}

function getCartSubTotal() // get sub total amount
{
    $total = 0;
    foreach (\Cart::content() as $product) {
        $total += ($product->price) * $product->qty;
    }
    return $total;
}

function getMainCartTotal() // get the total amount after minus the coupon amount
{
    if (Session::has('coupon')) {
        $coupon = Session::get('coupon');
        $subTotal = getCartSubTotal();
        if ($coupon['discount_type'] == 'amount') {
            $total = $subTotal - $coupon['discount'];
            return $total;
        } elseif ($coupon['discount_type'] == 'percent') {
            $discount = $subTotal - $subTotal * ($coupon['discount'] / 100);
            $total = $subTotal - $discount;
            return $total;
        }
    } else {
        return getCartSubTotal();
    }
}

/**get cart discount */

function getCartDiscount()
{
    if (Session::has('coupon')) {
        $coupon = Session::get('coupon');
        $subTotal = getCartSubTotal();
        if ($coupon['discount_type'] == 'amount') {
            return $coupon['discount'];
        } elseif ($coupon['discount_type'] == 'percent') {
            $discount = $subTotal * ($coupon['discount'] / 100);
            return $subTotal - $discount;
        }
    } else {
        return 0;
    }
}


