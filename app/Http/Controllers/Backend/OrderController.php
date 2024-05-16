<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class OrderController extends Controller
{
    public function index(): view
    {
        $total = 0;
        $orders = Order::with('user')->get();
        return view('admin.order.index', compact('orders', 'total'));
    }

    public function destroy(string $id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        $order->delete();

        toastr('Order deleted successfully!', 'success', 'Success');

        return redirect()->back();
    }
    public function getBill(string $id): view
    {
        $total = 0;
        $order = Order::findOrFail($id);
        $address = json_decode($order->order_address);
        return view('admin.order.bill', compact('order', 'address', 'total'));
    }
}
