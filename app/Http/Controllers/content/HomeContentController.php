<?php

// HomeContentController example
namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use Illuminate\Http\Request;

class HomeContentController extends Controller
{
    public function index()
    {
        $homeContent = HomeContent::first(); // Get the home content
        return view('admin.content.home.index', compact('homeContent'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'carousel_text_1' => 'required|string',
            'about_us_title' => 'required|string',
            'about_us_description' => 'required|string',
            // Add validation for other fields
        ]);

        $homeContent = HomeContent::first() ?? new HomeContent();

        // Handle image upload
        if ($request->hasFile('carousel_image_1')) {
            $path = $request->file('carousel_image_1')->store('public/uploads');
            $homeContent->carousel_image_1 = $path;
        }

        if ($request->hasFile('about_us_image')) {
            $path = $request->file('about_us_image')->store('public/uploads');
            $homeContent->about_us_image = $path;
        }

        // Update the rest of the content
        $homeContent->update($request->except(['carousel_image_1', 'about_us_image']));

        return redirect()->back()->with('success', 'Home content updated successfully.');
    }

}