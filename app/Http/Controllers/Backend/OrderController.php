<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $total = 0;
        $orders = Order::with('user')->get();
        return view('admin.order.index', compact('orders', 'total'));
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        toastr('Order deleted successfully!', 'success', 'Success');

        return redirect()->back();
    }
    public function getBill(string $id)
    {
        $total = 0;
        $order = Order::findOrFail($id);
        $address = json_decode($order->order_address);
        return view('admin.order.bill', compact('order', 'address', 'total'));
    }
}
