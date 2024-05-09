<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippings = Shipping::all();
        return view('admin.shipping.index', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shipping = Shipping::findOrFail($id);
        return view('admin.shipping.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

    public function changeStatus(Request $request)
    {
        $shipping = Shipping::findOrFail($request->id);
        $shipping->status = $request->status == 'true' ? 1 : 0;
        $shipping->save();

        return response(['message' => 'status has been updated'], 200);
    }
}
