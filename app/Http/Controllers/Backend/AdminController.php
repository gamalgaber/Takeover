<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    use ImageUploadTrait;
    public function dashboard(): view
    {
        $todaysOrders = Order::whereDate('created_at', Carbon::today())->count();
        $totalOrders = Order::count();
        $totalEarnings = Order::where('order_status', '!==', 'canceled')->whereDate('created_at', Carbon::today())->sum('total');
        $monthEarnings = Order::where('order_status', '!==', 'canceled')->whereMonth('created_at', Carbon::now()->month)->sum('total');
        $yearEarnings = Order::where('order_status', '!==', 'canceled')->whereYear('created_at', Carbon::now()->year)->sum('total');
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'user')->count();
        return view('admin.dashboard', compact(
            'todaysOrders',
            'totalOrders',
            'totalEarnings',
            'monthEarnings',
            'yearEarnings',
            'totalCategories',
            'totalProducts',
            'totalUsers'
        ));
    }

        public function profile(): view
        {
            return view('admin.profile.index');
        }

    public function updateAdminProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
            'image' => ['image', 'max:2048']
        ]);
        $user = Auth::user();

        $imagePath = $this->uploadImage($request, 'image', 'uploads');

        $user->image = $imagePath;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr('Profile updated Successfully!', 'success', 'Success');
        return redirect()->back();
    }

    public function updateAdminPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr('Password updated Successfully!', 'success', 'Success');
        return redirect()->back();
    }
}
