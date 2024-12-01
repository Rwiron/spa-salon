<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Provide;
use Illuminate\Http\Request;

class ProvideController extends Controller
{
    // Index to list all provides
    public function index()
    {
        $provides = Provide::all(); // Fetch all provides from the database
        return view('admin.content.provide.index', compact('provides'));
    }

    // Create view
    public function create()
    {
        return view('admin.content.provide.create');
    }

    // Store provide
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('provide', 'public');

        // Save provide data
        Provide::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath
        ]);

        return redirect()->route('provide.index')->with('success', 'Provide item created successfully.');
    }

    // Edit provide
    public function edit($id)
    {
        $provide = Provide::findOrFail($id);
        return view('admin.content.provide.edit', compact('provide'));
    }

    // Update provide
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $provide = Provide::findOrFail($id);

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('provide', 'public');
            $provide->image_path = $imagePath;
        }

        // Update provide data
        $provide->update([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $provide->image_path
        ]);

        return redirect()->route('provide.index')->with('success', 'Provide item updated successfully.');
    }

    // Delete provide
    public function destroy($id)
    {
        $provide = Provide::findOrFail($id);
        $provide->delete();

        return redirect()->route('provide.index')->with('success', 'Provide item deleted successfully.');
    }
}