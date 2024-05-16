<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductImageGalleryController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): view
    {
        $productImages = ProductImageGallery::where('product_id', $request->product)->get();
        $product = Product::findOrFail($request->product);
        return view('admin.product.image-gallery.index', compact('product', 'productImages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image.*' => ['required', 'image', 'max:2500'] //.* because it will receive array of images
        ]);

        /** handle image uploads */

        if($request->image == null){

            toastr('Provide Images first', 'error');

            return redirect()->back();
        }

        $images = $this->uploadMultiImage($request, 'image', 'uploads/products-gallery');

        foreach ($images as $image) {
            $productImageGallery = new ProductImageGallery();
            $productImageGallery->image = $image;
            $productImageGallery->product_id = $request->product;
            $productImageGallery->save();
        }

        toastr('Images Uploaded Successfully!', 'success');

        return redirect()->back();
    }


    public function destroy(string $id): RedirectResponse
    {
        $productImage = ProductImageGallery::findOrFail($id);
        $this->deleteImage($productImage->image);
        $productImage->delete();

        toastr('Deleted successfully!','success','Success');

        response(['status'=>'success','message'=>'deleted successfully!']);

        return redirect()->back();
    }
}
