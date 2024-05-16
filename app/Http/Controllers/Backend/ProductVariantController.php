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


class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): view
    {
        $productVariants = ProductVariant::where('product_id', $request->product)->get();
        $product = Product::findOrFail($request->product);
        return view('admin.product.product-variant.index', compact('product', 'productVariants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): view
    {
        return view('admin.product.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'product'=> ['integer','required'],
            'name'=> ['required','max:200'],
            'status'=> ['required']
        ]);

        $productVariant = new ProductVariant();

        $productVariant->product_id = $request->product;
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->save();

        toastr('Variant Crated Successfully!','success','Success');

        return redirect()->route('admin.product-variants.index' , ['product'=>$request->product]);
    }

    public function edit(string $id): view
    {
        $variant = ProductVariant::findOrFail($id);
        return view('admin.product.product-variant.edit', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name'=> ['required','max:200'],
            'status'=> ['required']
        ]);

        $productVariant = ProductVariant::findOrFail($id);

        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->save();

        toastr('Variant Updated Successfully!','success','Success');

        return redirect()->route('admin.product-variants.index', ['product' => $productVariant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $variant = ProductVariant::findOrFail($id);

        $variantItemCheck = ProductVariantItem::where('product_variant_id' , $variant->id)->count();
        if($variantItemCheck > 0){
            toastr('this variant contain items in it Delete the variant item first for delete this variant!','error','Error');

            response(['status'=>'error','message'=>'this variant contain items in it Delete the variant item first for delete this variant']);

            return redirect()->back();
        }
        $variant->delete();

        toastr('Variant Deleted successfully!','success','Success');

        response(['status'=>'success','message'=>'deleted successfully!']);

        return redirect()->back();
    }
    public function changeStatus(Request $request): Response
    {
        $productVariant = ProductVariant::findOrFail($request->id);
        $productVariant->status = $request->status == 'true' ? 1 : 0;
        $productVariant->save();

        return response(['message' => 'status has been updated'], 200);
    }
}
