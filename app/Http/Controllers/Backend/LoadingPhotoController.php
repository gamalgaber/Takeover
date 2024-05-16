<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LoadingPhoto;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoadingPhotoController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(): view
    {
        $loadingPhotos = LoadingPhoto::all();
        return view('admin.loading-photo.index',compact('loadingPhotos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): view
    {
        return view('admin.loading-photo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'banner' => ['required', 'image', 'max:5000'],
            'title' => ['required', 'min:8', 'max: 30'],
            'button_url' => ['nullable', 'url'],
            'status' => ['required']
        ]);
        $loadingPhoto = new LoadingPhoto();

        $imagePath = $this->uploadImage($request, 'banner', 'uploads/loading-photos');

        $loadingPhoto->banner = $imagePath;
        $loadingPhoto->title = $request->title;
        $loadingPhoto->button_url = $request->button_url;
        $loadingPhoto->status = $request->status;
        $loadingPhoto->save();

        toastr('Loading photo created successfully!','success','Success');

        return redirect()->route('admin.Loading-photo.index');
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
        $loadingPhoto = LoadingPhoto::findOrFail($id);
        return view('admin.loading-photo.edit',compact('loadingPhoto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'banner' => ['nullable', 'image', 'max:5000'],
            'title' => ['required', 'min:8', 'max: 30'],
            'button_url' => ['nullable', 'url'],
            'status' => ['required']
        ]);

        $loadingPhoto = LoadingPhoto::findOrFail($id);

        $image = $this->updateImage($request, 'banner', 'uploads/loading-photos', $loadingPhoto->banner);


        $loadingPhoto->banner = empty(!$image) ? $image : $loadingPhoto->banner;
        $loadingPhoto->title = $request->title;
        $loadingPhoto->button_url = $request->button_url;
        $loadingPhoto->status = $request->status;
        $loadingPhoto->save();

        toastr('Loading photo updated successfully!','success','Success');

        return redirect()->route('admin.Loading-photo.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $loadingPhoto = LoadingPhoto::findOrFail($id);
        $this->deleteImage($loadingPhoto->banner);
        $loadingPhoto->delete();

        toastr('Deleted successfully!','success','Success');

        response(['status'=>'success','message'=>'deleted successfully!']);

        return redirect()->route('admin.Loading-photo.index');
    }
    public function changeStatus(Request $request)
    {
        $loadingPhoto = LoadingPhoto::findOrFail($request->id);
        $loadingPhoto->status = $request->status == 'true' ? 1 : 0;
        $loadingPhoto->save();

        return response(['message' => 'status has been updated'], 200);
    }
}
