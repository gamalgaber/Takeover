<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomePageSettings;
use App\Models\LoadingPhoto;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): view
    {
        $loadingPhoto = LoadingPhoto::where('status', 1)->first();
        $products = Product::with(['productImageGalleries', 'variants'])->where(['status' => 1, 'is_approved' => 1])->orderBy('id', 'desc')->take(15)->get();
        $typeBaseProducts = $this->getTypeBaseProduct();
        $homePageTitles = HomePageSettings::first();
        $categories = Category::with(['product' => function ($query) {
            $query->with('productImageGalleries');
        }])->orderBy('name', 'ASC')->get();
        return view('frontend.home.home',
        compact(
            'loadingPhoto',
            'products',
            'typeBaseProducts',
            'homePageTitles',
            'categories'
            ));
    }
    public function getTypeBaseProduct(): array
    {
        $typeBaseProducts = [];

        $typeBaseProducts['new_arrival'] = Product::where(['product_type'=>'new_arrival','is_approved'=>1,'status'=>1])->orderBy('id','desc')->take(8)->get();
        $typeBaseProducts['top_product'] = Product::where(['product_type'=>'top_product','is_approved'=>1,'status'=>1])->orderBy('id','desc')->take(8)->get();
        $typeBaseProducts['featured_product'] = Product::where(['product_type'=>'featured_product','is_approved'=>1,'status'=>1])->orderBy('id','desc')->take(8)->get();
        $typeBaseProducts['best_product'] = Product::where(['product_type'=>'best_product','is_approved'=>1,'status'=>1])->orderBy('id','desc')->take(8)->get();

        return $typeBaseProducts;
    }

}
