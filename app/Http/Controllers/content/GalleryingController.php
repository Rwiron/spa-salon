<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryingController extends Controller
{
    // Display all gallery images
    public function index()
    {
        // Paginate the gallery records, 5 per page
        $galleries = Gallery::paginate(10);
        return view('admin.content.gallery.index', compact('galleries'));
    }

    // Show the form to create a new gallery image
    public function create()
    {
        return view('admin.content.gallery.create');
    }

    // Store the new gallery image
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Restrict to JPG, JPEG, and PNG formats
        ]);

        // Get the original name of the uploaded file
        $originalName = $request->file('image')->getClientOriginalName();

        // Store the uploaded image
        $imagePath = $request->file('image')->store('gallery', 'public');

        // Save the gallery image information to the database
        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'original_name' => $originalName, // Save the original file name
        ]);

        return redirect()->route('gallery.index')->with('success', 'Gallery image added successfully.');
    }


    // Delete a gallery image
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Delete the image from storage
        Storage::disk('public')->delete($gallery->image_path);

        // Delete the gallery record
        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Gallery image deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        // Validate that we have received an array of IDs
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:galleries,id', // Ensure all IDs exist in the galleries table
        ]);

        // Delete the selected gallery records
        Gallery::whereIn('id', $request->ids)->delete();

        // Return success response
        return response()->json(['success' => true, 'message' => 'Selected gallery images have been deleted.']);
    }

}