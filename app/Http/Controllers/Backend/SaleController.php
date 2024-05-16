<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function index(): view
    {
        $sale = Sale::first();
        $products = Product::where('is_approved', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
        $saleItems = SaleItem::all();
        return view('admin.sale.index', compact('sale', 'products', 'saleItems'));
    }
    function update(Request $request): RedirectResponse
    {
        $request->validate([
            'end_date' => ['required']
        ]);


        $sale = Sale::first();

        if($request->end_date === $sale->end_date){

            toastr('Choose the date first!', 'error', 'Error');

            return redirect()->back();

        }else{
            Sale::updateOrCreate(['id' => 1], ['end_date' => $request->end_date]);
            toastr('Updated Successfully!', 'success', 'Success');

            return redirect()->back();
        }

    }
    function addProduct(Request $request): RedirectResponse
    {
        $request->validate([
            'product' => ['required', 'unique:sale_items,product_id'],
            'show_at_home' => ['required'],
            'status' => ['required']
        ],[
            'product.unique' => 'The product is already in flash sale'
        ]);


        $sale = Sale::first();

        $saleItem = new SaleItem();
        $saleItem->product_id = $request->product;
        $saleItem->status = $request->status;
        $saleItem->show_at_home = $request->show_at_home;
        $saleItem->sale_id = $sale->id;
        $saleItem->save();

        toastr('Product Added Successfully', 'success', 'Success');

        return redirect()->back();
    }
    public function destroy(Request $request): Response
    {
        $saleItem = SaleItem::findOrFail($request->id);
        $saleItem->delete();

        toastr('Deleted successfully!','success','Success');

        response(['status'=>'success','message'=>'Deleted successfully!']);

        return redirect()->back();
    }
    public function changeShowAtHome(Request $request): Response
    {
        $saleItem = SaleItem::findOrFail($request->id);
        $saleItem->show_at_home = $request->status == 'true' ? 1 : 0;
        $saleItem->save();

        return response(['message' => 'Show-At-Home has been updated'], 200);
    }
    public function changeStatus(Request $request): Response
    {
        $saleItem = SaleItem::findOrFail($request->id);
        $saleItem->status = $request->status == 'true' ? 1 : 0;
        $saleItem->save();

        return response(['message' => 'Status has been updated'], 200);
    }

}
