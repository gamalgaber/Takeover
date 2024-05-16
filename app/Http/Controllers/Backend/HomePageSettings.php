<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomePageSettings as ModelsHomePageSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomePageSettings extends Controller
{
    public function index(): view
    {
        $homePage = ModelsHomePageSettings::all();
        return view('admin.home-page-setting.index', compact('homePage'));
    }

    public function edit(string $id): view
    {
        $homePage = ModelsHomePageSettings::findOrFail($id);
        return view('admin.home-page-setting.edit', compact('homePage'));
    }
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'products_title' => ['required', 'min:8', 'max: 30'],
            'categories_title' => ['required', 'min:8', 'max: 30'],
            'filter_categories_title' => ['required', 'min:8', 'max: 30'],
        ]);

        $homePage = ModelsHomePageSettings::findOrFail($id);

        $homePage->products_title = $request->products_title;
        $homePage->categories_title = $request->categories_title;
        $homePage->filter_categories_title = $request->filter_categories_title;
        $homePage->save();

        toastr('Titles updated successfully!','success','Success');

        return redirect()->route('admin.home-page-settings');
    }
}
