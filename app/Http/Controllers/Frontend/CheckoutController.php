<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Models\Transaction;
use App\Models\UserAddress;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Cart;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index()
    {
        if(Cart::content()->count() == 0){
            toastr('warning','warning','you do not allow to enter this page get product first');
            return redirect()->route('home');
        }
        $categories = Category::where('status', 1)->get();
        $cartItems = Cart::content();
        $subTotal = 0;
        return view('frontend.pages.checkout', compact('cartItems', 'categories', 'subTotal'));
    }

    public function buyNow(string $id): view
    {
        $categories = Category::where('status', 1)->get();
        $cartItems = Cart::content();

        $product = Product::where('id', $id)->first();

        $subTotal = $product->price;
        return view('frontend.pages.checkout', compact('product', 'categories', 'cartItems', 'subTotal'));
    }



    public function applyCoupon(Request $request): Response
    {
        if ($request->coupon_code == null) {
            return response(['status' => 'error', 'message' => 'coupon field is required']);
        }

        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();

        if ($coupon == null) {
            return response(['status' => 'error', 'message' => 'coupon is not exist']);
        } else if ($coupon->start_date > date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'coupon is not available yet!']);
        } else if ($coupon->end_date < date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'coupon is expired!']);
        } else if ($coupon->quantity  <= $coupon->total_used) {
            return response(['status' => 'error', 'message' => 'you can not apply this coupon!']);
        }

        if ($coupon->discount_type == 'amount') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount
            ]);
        } elseif ($coupon->discount_type == 'percent') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount' => $coupon->discount
            ]);
        }

        return response(['status' => 'success', 'message' => 'coupon applied successfully!']);
    }
    public function couponCalculation()
    {
        $total = 0;
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            $subTotal = getCartSubTotal();
            if ($coupon['discount_type'] == 'amount') {
                $total = $subTotal - $coupon['discount'];
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
            } elseif ($coupon['discount_type'] == 'percent') {
                $discount = $subTotal - $subTotal * ($coupon['discount'] / 100); //849 - 849 * (10/100)
                $discount = ceil($discount);

                $total = $subTotal - $discount;
                $total = round($total, 2);
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $discount]);
            }
        } else {
            $total = getCartSubTotal();
            return response(['status' => 'success', 'cart_total' => $total, 'discount' => '0']);
        }
    }
    public function checkoutFormSubmit(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'phone' => ['required', 'max:20'],
            'email' => ['required', 'email'],
            'government' => ['required', 'max:50'],
            'city' => ['required', 'max:50'],
            'postal_code' => ['required', 'max:50'],
            'address' => ['required', 'max:200'],
            'shipping_price' => ['required']
        ]);

        $checkoutType = $request->input('checkout_type');

        if($checkoutType == 'buyNow'){
            $productId = $request->input('product_id');
            $product = Product::find($productId);
            $total = $product->price;
//            dd($request->all());

            $totalAmount = $total + $request->shipping_price ;
        }else {
            $cartItems = Cart::content();

            $cartTotal = 0;
            foreach($cartItems as $item){
                $cartTotal +=  $item->price;
            }
            $totalAmount = $cartTotal + $request->shipping_price ;
        }

        $address = new UserAddress();
        $address->user_id = Auth::user() ? Auth::user()->id : $request->first_name . " " . $request->last_name;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->government = $request->government;
        $address->city = $request->city;
        $address->postal_code = $request->postal_code;
        $address->address = $request->address;
        $address->save();


        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'government' => $request->government,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
        ];
        $userAddress = json_encode($data);


        $transactionId = uniqid();
        $this->storeOrder('cash-on-delivery', 1 , $transactionId , $totalAmount, $userAddress, $request->shipping_price, $request);
        if ($checkoutType == 'cart') {
            session()->forget('cart');
        }
        return redirect()->route('home');
    }
    public function calculateShippingCost(Request $request): Response
    {
        $government = $request->input('government');

        if (in_array($government, ['Aswan', 'Asyut', 'Luxor', 'Minya', 'Matruh', 'New Valley', 'North Sinai', 'South Sinai', 'Red Sea', 'Qena', 'Sohag'])) {
            $cost = 100;
        } elseif (in_array($government, ['Alexandria', 'Beheira', 'Beni Suef', 'Dakahlia', 'Damietta', 'Faiyum', 'Gharbia', 'Ismailia', 'Kafr El Sheikh', 'Monufia', 'Qalyubia', 'Sharqia', 'Suez'])) {
            $cost = 70;
        } else {
            $cost = 50;
        }

        // Return the shipping cost as JSON response
        return response(['status'=>'success','cost' => $cost]);
    }

    private function storeOrder($paymentMethod, $paymentStatus, $transactionId, $total, $orderAddress, $shippingPrice, Request $request): void
    {
        $checkoutType = $request->input('checkout_type');
        $order = new Order();
        $order->invoice_id = rand(1, 999999) . "_" . rand(1, 8000);
        $order->user_id = Auth::user()? Auth::user()->id : $request->first_name . " " . $request->last_name;
        $order->total = $total;
        if($checkoutType == 'cart'){
        $order->product_quantity = \Cart::content()->count();
        }else {
        $order->product_quantity = 1;
        }
        $order->payment_method = $paymentMethod;
        $order->payment_status = $paymentStatus;
        $order->order_address = $orderAddress;
        $order->shipping_price = $shippingPrice;
        $order->coupon = json_encode(Session::get('coupon')) ? json_encode(Session::get('coupon')) : '';
        $order->order_status = 'pending';
        $order->save();

        /** Store Order Products Cart*/
        if($checkoutType == 'cart') {
            foreach (\Cart::content() as $item) {
                $product = Product::find($item->id);
                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $product->id;
                $orderProduct->product_name = $product->name;
                $orderProduct->variants = json_encode($item->options->variants);
                $orderProduct->unit_price = $item->price;
                $orderProduct->quantity = $item->qty;
                $orderProduct->save();

                // update product quantity
                $updatedQty = ($product->quantity - $item->qty);
                $product->quantity = $updatedQty;
                $product->save();
            }
        }else {
            $productId = $request->input('product_id');
            $product = Product::find($productId);
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->id;
            $orderProduct->product_name = $product->name;
            $variantId = $request->input('variant_id');
            $orderProduct->variants = $variantId;
            $orderProduct->unit_price = $product->price;
            $orderProduct->quantity = 1;
            $orderProduct->save();

            // update product quantity
            $updatedQty = ($product->quantity - 1);
            $product->quantity = $updatedQty;
            $product->save();
        }
        // store transaction details
        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_id = $transactionId;
        $transaction->payment_method = $paymentMethod;
        $transaction->amount = $total;
        $transaction->save();
    }
}
