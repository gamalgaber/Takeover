<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartController extends Controller
{
    public function cart(): view
    {
        $categories = Category::where('status', 1)->get();
        $cartItems = Cart::content();
        if (count($cartItems) == 0) {
            Session::forget('coupon');
            // toastr('Cart is empty', 'warning', 'warning');
            // return redirect()->route('home');
        }
        return view('frontend.pages.cart', compact('cartItems', 'categories'));
    }
    public function addToCart(Request $request): Response
    {
        $productId = $request->input('product_id');

        $product = Product::findOrFail($productId);

        //check product quantity in database
        if ($product->quantity == 0) {
            return response(['status' => 'stock_out', 'message' => 'product stock out']);
        } else if ($product->quantity < $request->qty) {
            return response(['status' => 'stock_out', 'message' => 'Quantity not available']);
        }


        if ($request->has('variant_name')) {
            $variantName = $request->input('variant_name');
                $variants = $variantName;
        }

        // check Discount
        $productPrice = 0;
        if (checkDiscount($product)) {
            $productPrice += $product->offer_price;
        } else {
            $productPrice += $product->price;
        }
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->quantity,
            'price' =>  $productPrice,
            'weight' => 10,
            'options' => [
                'variants' => $variants,
                'image' => $product->image,
                'slug' => $product->slug
            ]
        ]);

        return response(['status' => 'success', 'message' => 'Added successfully!']);
    }

    public function updateProductQuantity(Request $request): Response
    {
        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);

        //check product quantity in database
        if ($product->quantity == 0) {
            return response(['status' => 'stock_out', 'message' => 'product stock out']);
        } else if ($product->quantity < $request->quantity) {
            return response(['status' => 'stock_out', 'message' => 'Quantity not available']);
        }

        Cart::update($request->rowId, $request->quantity);
        // $productTotal = $this->getProductTotal($request->rowId);'product_total' => $productTotal
        return response(['status' => 'success', 'message' => 'product quantity updated']);
    }
    public function getCartCount(): int
    {
        return Cart::content()->count();
    }
    public function cartTotal(): int
    {
        $total = 0;
        foreach (Cart::content() as $product) {
            $total += $this->getProductTotal($product->rowId);
        }
        return $total;
    }
    public function removeProduct($rowId): RedirectResponse
    {
        Cart::remove($rowId);

        return redirect()->back();
    }
    public function clearCart(): Response
    {
        Cart::destroy();

        return response(['status' => 'success', 'message' => 'Cart Cleared']);
    }
}
