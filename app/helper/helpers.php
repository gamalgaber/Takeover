<?php
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

function checkProductType(string $type): ?string
{
    switch ($type) {
        case 'new_arrival':
            return 'New';
        case 'featured_product':
            return 'Featured';
        case 'top_product':
            return 'Top';
        case 'sale':
            return 'Sale';
        default:
            return  '';
    }
}
function checkDiscount($product): bool
{
    $currentDate = date('Y-m-d');
    if ($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
        return true;
    }
    return false;
}

function getCartSubTotal(): int // get sub total amount
{
    $total = 0;
    foreach (\Cart::content() as $product) {
        $total += ($product->price) * $product->qty;
    }
    return $total;
}


