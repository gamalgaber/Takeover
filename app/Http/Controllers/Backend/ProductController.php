<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(): view
    {
        $products = Product::with('category')->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): view
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category_id' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'short_description' => ['required', 'max:250'],
            'product_type' => ['required'],
            'instagram_link' => ['nullable', 'url'],
            'status' => ['required']
        ]);
        $product = new Product();

        $image = $this->uploadImage($request, 'image', 'uploads/products-images');

        $product->image = $image;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->instagram_link = $request->instagram_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 1;
        $product->save();

        toastr('Product created successfully!','success','Success');

        return redirect()->route('admin.products.index');
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
    public function edit(string $id): view
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category_id' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'short_description' => ['required', 'max:250'],
            'product_type' => ['required'],
            'instagram_link' => ['nullable', 'url'],
            'status' => ['required']
        ]);
        $product = Product::findOrFail($id);

        $image = $this->updateImage($request, 'image', 'uploads/products-images');

        $product->image = empty(!$image) ? $image : $product->image;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->instagram_link = $request->instagram_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 1;
        $product->save();

        toastr('Product Updated successfully!','success','Success');

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        // if(OrderProduct::where('product_id',$product->id)->count() > 0){
        //     return response(['status'=>'error','message'=>'This Product can not be deleted because it have orders']);
        // }
        /**delete main product imgae */
        $this->deleteImage($product->image);

        /**delete product images */
        $productImages = ProductImageGallery::where('product_id', $product->id)->get();
        foreach($productImages as $image){
            $this->deleteImage($image->image);
            $image->delete();
        }

        /**Delete product variant if exist*/
        $variants = ProductVariant::where('product_id', $product->id)->get();
        foreach($variants as $variant){
            $variant->productVariantItem()->delete();
            $variants->delete();
        }

        $product->delete();

        toastr('Deleted successfully!','success','Success');

        response(['status'=>'success','message'=>'deleted successfully!']);

        return redirect()->route('admin.products.index');
    }
    public function changeStatus(Request $request): Response
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response(['message' => 'status has been updated'], 200);
    }
}
