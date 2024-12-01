<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutingController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('admin.content.about.index', compact('about'));
    }
    public function edit()
    {
        $about = About::first(); // Get the first record from the about table

        return view('admin.content.about.edit', compact('about'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'spa_specialists_count' => 'required|integer',
            'happy_clients_count' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image if provided
        ]);

        // Fetch the existing About record or create a new one if it doesn't exist
        $about = About::firstOrNew();

        // Update or set the fields
        $about->title = $request->title;
        $about->subtitle = $request->subtitle;
        $about->description = $request->description;
        $about->spa_specialists_count = $request->spa_specialists_count;
        $about->happy_clients_count = $request->happy_clients_count;

        // Handle file upload if a new image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('about', 'public'); // Save to 'public/about' folder
            $about->image_path = $imagePath;
        }

        // Save the record (will either update or insert a new one)
        $about->save();

        return redirect()->route('about.index')->with('success', 'About section updated successfully.');
    }

}