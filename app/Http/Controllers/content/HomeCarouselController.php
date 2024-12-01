<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Storage;

class HomeCarouselController extends Controller
{
    // Display all carousel items
    public function index()
    {
        $carousels = Carousel::paginate(10); // 10 items per page
        return view('admin.content.carousel.index', compact('carousels'));
    }

    // Show form to create a new carousel item
    public function create()
    {
        return view('admin.content.carousel.create');
    }

    // Store a newly created carousel item
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'subtitle' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     // Handle file upload
    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('carousels', 'public'); // Store the image in the 'public/carousels' directory
    //     }

    //     // Save the carousel item with the image path
    //     Carousel::create([
    //         'title' => $request->title,
    //         'subtitle' => $request->subtitle,
    //         'description' => $request->description,
    //         'image_path' => $imagePath,  // Store the image path
    //     ]);

    //     return redirect()->route('home.carousel.index')->with('success', 'Carousel item created successfully.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            // Get the original file name
            $originalName = $request->file('image')->getClientOriginalName();

            // Store the image in the 'public/carousel' directory and keep the original name
            $imagePath = $request->file('image')->storeAs('carousel', time() . '_' . $originalName, 'public');
        }

        // Save the carousel item with the image path
        Carousel::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'image_path' => $imagePath,  // Store the image path
        ]);

        return redirect()->route('home.carousel.index')->with('success', 'Carousel item created successfully.');
    }


    // Display the edit form for a specific carousel item
    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('admin.content.carousel.edit', compact('carousel'));
    }

    // Handle the update of a specific carousel item
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional
        ]);

        $carousel = Carousel::findOrFail($id);

        // If there's a new image, upload it
        if ($request->hasFile('image')) {
            // Get original image name
            $originalName = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('carousel', time() . '_' . $originalName, 'public');

            // Delete the old image if it exists
            if ($carousel->image_path) {
                Storage::delete('public/' . $carousel->image_path);
            }

            // Update the image path
            $carousel->image_path = $imagePath;
        }

        // Update the rest of the fields
        $carousel->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
        ]);

        return redirect()->route('home.carousel.index')->with('success', 'Carousel item updated successfully.');
    }


    // Delete a carousel item
    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);
        $carousel->delete();

        return redirect()->route('home.carousel.index')->with('success', 'Carousel item deleted successfully.');
    }
}