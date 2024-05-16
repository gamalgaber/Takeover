<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CollectionController extends Controller
{
    public function index(Request $request): view
    {
        if($request->has('category')){
            $category = Category::where('slug',$request->category)->first();
            $products = Product::with('productImageGalleries')->where([
                'category_id'=>$category->id,
                'status' => 1,
                'is_approved'=> 1,
            ])->orderBy('id','desc')->take(12)->get();
        }else {
            $products = Product::with('productImageGalleries')->where(['status' => 1, 'is_approved'=> 1])->orderBy('id','desc')->paginate(12);
        }
        $categories = Category::where('status', 1)->get();
        return view('frontend.pages.collections', compact('products','category', 'categories'));
    }
}
