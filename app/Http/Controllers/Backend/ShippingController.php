<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;


class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): view
    {
        $shippings = Shipping::all();
        return view('admin.shipping.index', compact('shippings'));
    }


    public function edit(string $id): view
    {
        $shipping = Shipping::findOrFail($id);
        return view('admin.shipping.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'cost' => ['required', 'integer'],
            'status' => ['required', 'boolean'],
        ]);

        $shippingRule = Shipping::findOrFail($id);

        $shippingRule->name = $request->name;
        $shippingRule->cost = $request->cost;
        $shippingRule->status = $request->status;
        $shippingRule->save();

        toastr('Shipping Updated Successfully!', 'success', 'Success');

        return redirect()->route('admin.shipping.index');
    }

    public function changeStatus(Request $request): Response
    {
        $shipping = Shipping::findOrFail($request->id);
        $shipping->status = $request->status == 'true' ? 1 : 0;
        $shipping->save();

        return response(['message' => 'status has been updated'], 200);
    }
}
