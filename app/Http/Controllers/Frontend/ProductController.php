<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function showProduct(string $slug): view
    {
        $product = Product::with(['category','productImageGalleries','variants'])->where('slug', $slug)->where('status',1)->first();
        $categories = Category::where('status', 1)->get();
        return view('frontend.pages.product-detail',compact('product', 'categories'));
    }
}
