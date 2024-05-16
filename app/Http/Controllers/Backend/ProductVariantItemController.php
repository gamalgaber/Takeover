<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductVariantItemController extends Controller
{
    public function index($productId, $variantId): view
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        $variantItems = ProductVariantItem::where('product_variant_id', $variantId)->get();
        return view('admin.product.product-variant-item.index',compact('product', 'variant', 'variantItems'));
    }
    public function create(string $productId , string $variantId): view
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return view('admin.product.product-variant-item.create',compact('product', 'variant'));
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'variant_id' => ['required', 'integer'],
            'name' => ['required', 'max:200'],
            'is_default' => ['required'],
            'status' => ['required'],
        ]);

        $variantItem = new ProductVariantItem();

        $variantItem->product_variant_id = $request->variant_id;
        $variantItem->name = $request->name;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
        $variantItem->save();


        toastr('Varaiant Item Created Successfully!','success','Success');

        return redirect()->route('admin.product-variant-item.index' , ['productId' => $request->product_id , 'variantId' => $request->variant_id]);
    }
    public function edit(string $variantItemId): view
    {
        $variantItem = ProductVariantItem::findOrFail($variantItemId);
        $variant = ProductVariant::where('id', $variantItem->variant_id)->first();
        return view('admin.product.product-variant-item.edit', compact('variantItem', 'variant'));
    }
    public function update(string $variantItemId , Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'is_default' => ['required'],
            'status' => ['required'],
        ]);

        $variantItem = ProductVariantItem::findOrFail($variantItemId);

        $variantItem->name = $request->name;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
        $variantItem->save();


        toastr('Data Updated Successfully!','success','Success');

        return redirect()->route('admin.product-variant-item.index' , ['productId' => $variantItem->productVariant->product_id , 'variantId' => $variantItem->variant_id]);
    }
    public function destroy(string $variantId): RedirectResponse
    {
        $variantItem = ProductVariantItem::findOrFail($variantId);
        $variantItem->delete();

        toastr('Deleted successfully!','success','Success');

        response(['status'=>'success','message'=>'Data Deleted successfully!']);

        return redirect()->back();
    }

    function changeStatus(Request $request): Response
    {
        $variantItem = ProductVariantItem::findOrFail($request->id);

        $variantItem->status = $request->status == 'true' ? 1 : 0;
        $variantItem->save();

        return response(['message' => 'status has been updated'], 200);
    }
}
