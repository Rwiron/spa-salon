<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Storage;


class TestimController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.content.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.content.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'testimonial' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('testimonials', 'public') : null;

        Testimonial::create([
            'client_name' => $request->client_name,
            'profession' => $request->profession,
            'testimonial' => $request->testimonial,
            'image' => $imagePath,
        ]);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.content.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        // Retrieve the testimonial
        $testimonial = Testimonial::findOrFail($id);

        // Validate the incoming request
        $request->validate([
            'client_name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'testimonial' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add some validation rules for the image
        ]);

        // Check if an image was uploaded, if yes, handle the upload
        if ($request->hasFile('image')) {
            // Store the new image and delete the old one if necessary
            if ($testimonial->image) {
                Storage::delete('public/' . $testimonial->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('testimonials', 'public');
        } else {
            // If no new image is uploaded, retain the old one
            $imagePath = $testimonial->image;
        }

        // Update the testimonial
        $testimonial->update([
            'client_name' => $request->client_name,
            'profession' => $request->profession,
            'testimonial' => $request->testimonial,
            'image' => $imagePath,
        ]);

        // Redirect with a success message
        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully.');
    }


    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
