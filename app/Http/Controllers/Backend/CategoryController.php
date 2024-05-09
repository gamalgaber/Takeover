<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Str;
class CategoryController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:30','unique:categories,name'],
            'image' => ['nullable','image', 'max:3000'],
            'status' => ['required']
        ]);


        $category = new Category();

        $image = $this->uploadImage($request, 'image', 'uploads/categories-images');

        $category->name = $request->name;
        $category->image = $image ? $image : '';
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;

        $category->save();

        toastr('Category Created successfully!','success','Success');
        return redirect()->route('admin.category.index');
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
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['max:30'],
            'image' => ['nullable','image', 'max:3000'],
            'status' => ['required']
        ]);


        $category = Category::findOrFail($id);

        $image = $this->updateImage($request, 'image', 'uploads/categories-images');

        $category->name = $request->name;
        $category->image = $image ? $image : '';
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;

        $category->save();

        toastr('Category Updated successfully!','success','Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        toastr('Deleted successfully!','success','Success');

        response(['status'=>'success','message'=>'deleted successfully!']);

        return redirect()->route('admin.category.index');
    }
    public function changeStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'status has been updated'], 200);
    }
}
