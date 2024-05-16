<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function index(): view
    {
        $categories = Category::where('status', 1)->get();
        $wishlistProducts = Wishlist::with('product')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('frontend.pages.wishlist', compact('wishlistProducts', 'categories'));
    }

    public function addToWishlist(Request $request): Response
    {
        if(!Auth::check()){
            return response(['status'=>'error','message'=>'Login Before Add product into wishlist']);
        }
        $wishlistCount = Wishlist::where(['product_id' => $request->id,'user_id' => Auth::user()->id])->count();

        if($wishlistCount > 0){
            return response(['status'=>'error','message'=>'the product is already at wishlist']);
        }

        $wishlist = new Wishlist();

        $wishlist->product_id = $request->id;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->save();

        $count = Wishlist::where('user_id', Auth::user()->id)->count();

        return response(['status'=>'success','message'=>'product added to wishlist', 'count' =>  $count]);
    }
    public function removeFromWishlist(string $id): RedirectResponse
    {
        $wishlistProducts = Wishlist::where('id', $id)->findOrFail($id);
        if($wishlistProducts->user_id !== Auth::user()->id){
            return redirect()->back();
        }
        $wishlistProducts->delete();

        toastr('Product removed successfully!', 'success', 'success');

        return redirect()->back();
    }

    public function countWishlistItems(): int
    {
        $count = Wishlist::where('user_id', Auth::user()->id)->count();
        return $count;
    }
}
