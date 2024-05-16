<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait ImageUploadTrait
{
    public function uploadImage(Request $request, $inputName, $path)
    {
        // $user = Auth::user();

        if ($request->hasFile($inputName)) {
            $image = $request->{$inputName};

            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid() . '.' . $ext;
            $image->move(public_path($path), $imageName);

            return $path.'/'.$imageName;
        }
    }
    public function updateImage(Request $request, $inputName, $path, $oldPath=null)
    {
        if ($request->hasFile($inputName)) {
            if(File::exists(public_path($oldPath)))//check if file is exists
                {
                    File::delete(public_path($oldPath));
                }
            $image = $request->{$inputName};

            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid() . '.' . $ext;
            $image->move(public_path($path), $imageName);

            return $path.'/'.$imageName;
        }
    }
    public function deleteImage(string $path): void
    {
        if(File::exists(public_path($path)))//check if file is exists
        {
            File::delete(public_path($path));
        }
    }

    public function uploadMultiImage(Request $request, $inputName, $path)
    {
        $imagePaths = [];

        if ($request->hasFile($inputName)) {

            $images = $request->{$inputName};

            foreach($images as $image){
                $ext = $image->getClientOriginalExtension();
                $imageName = 'media_'.uniqid() . '.' . $ext;

                $image->move(public_path($path), $imageName);

                $imagePaths[] = $path.'/'.$imageName;
            }
            return $imagePaths;
        }
    }
}
