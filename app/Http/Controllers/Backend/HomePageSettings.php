<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomePageSettings as ModelsHomePageSettings;
use Illuminate\Http\Request;

class HomePageSettings extends Controller
{
    public function index()
    {
        $homePage = ModelsHomePageSettings::all();
        return view('admin.home-page-setting.index', compact('homePage'));
    }

    public function edit(string $id)
    {
        $homePage = ModelsHomePageSettings::findOrFail($id);
        return view('admin.home-page-setting.edit', compact('homePage'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'products_title' => ['required', 'min:8', 'max: 30'],
            'categories_title' => ['required', 'min:8', 'max: 30'],
        ]);

        $homePage = ModelsHomePageSettings::findOrFail($id);

        $homePage->products_title = $request->products_title;
        $homePage->categories_title = $request->categories_title;
        $homePage->save();

        toastr('Titles updated successfully!','success','Success');

        return redirect()->route('admin.home-page-settings');
    }
}
