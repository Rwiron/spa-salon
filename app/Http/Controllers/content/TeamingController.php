<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamingController extends Controller
{
    // Display all team members
    public function index()
    {
        $teams = Team::all();
        return view('admin.content.team.index', compact('teams'));
    }

    // Show form to create a new team member
    public function create()
    {
        return view('admin.content.team.create');
    }

    // Store the new team member
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'facebook_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload if an image is provided
        if ($request->hasFile('image')) {
            $originalName = $request->file('image')->getClientOriginalName(); // Get original filename
            $imageName = time() . '_' . $originalName; // Append timestamp to avoid conflicts
            $imagePath = $request->file('image')->storeAs('team', $imageName, 'public');
            $validatedData['image'] = $imagePath;
        }

        // Save the team member
        Team::create($validatedData);

        return redirect()->route('team.index')->with('success', 'Team member added successfully.');
    }


    // Show form to edit a team member
    public function edit($id)
    {
        $team = Team::findOrFail($id);
        return view('admin.content.team.edit', compact('team'));
    }

    // Update the team member
    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'facebook_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload if an image is provided
        if ($request->hasFile('image')) {
            $originalName = $request->file('image')->getClientOriginalName(); // Get original filename
            $imageName = time() . '_' . $originalName; // Append timestamp to avoid conflicts
            $imagePath = $request->file('image')->storeAs('team', $imageName, 'public');
            $validatedData['image'] = $imagePath;
        }

        // Update the team member
        $team->update($validatedData);

        return redirect()->route('team.index')->with('success', 'Team member updated successfully.');
    }

    // Delete a team member
    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        if ($team->image_path) {
            \Storage::delete('public/' . $team->image_path);
        }
        $team->delete();
        return redirect()->route('team.index')->with('success', 'Team member deleted successfully.');
    }
}