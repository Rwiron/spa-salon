<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\OpenHour;
use Illuminate\Http\Request;

class OpenHoursController extends Controller
{
    // Display the open hours section
    public function index()
    {
        $openHours = OpenHour::first();
        return view('admin.content.openhours.index', compact('openHours'));
    }

    // Show the form to edit the open hours
    public function edit()
    {
        // Retrieve the first OpenHours record from the database
        $openHours = OpenHour::first();

        // Check if open hours data exists
        if (!$openHours) {
            return redirect()->route('openhours.index')->with('error', 'Open hours not found.');
        }

        // Pass the open hours data to the view
        return view('admin.content.openhours.edit', compact('openHours'));
    }


    // // Update the open hours data
    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'subtitle' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'weekday_hours' => 'required|string',
    //         'saturday_hours' => 'required|string',
    //         'sunday_hours' => 'nullable|string',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $openHours = OpenHour::first();

    //     // Handle file upload for the image
    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('openhours', 'public');
    //     } else {
    //         $imagePath = $openHours->image_path; // Keep the old image if no new image is uploaded
    //     }

    //     $openHours->update([
    //         'title' => $request->title,
    //         'subtitle' => $request->subtitle,
    //         'description' => $request->description,
    //         'weekday_hours' => $request->weekday_hours,
    //         'saturday_hours' => $request->saturday_hours,
    //         'sunday_hours' => $request->sunday_hours,
    //         'image_path' => $imagePath,
    //     ]);

    //     return redirect()->route('openhours.index')->with('success', 'Open Hours updated successfully.');
    // }

    public function update(Request $request)
    {
        // Validation for string and time fields
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'weekday_start' => 'required|date_format:H:i',
            'weekday_end' => 'required|date_format:H:i',
            'saturday_start' => 'required|date_format:H:i',
            'saturday_end' => 'required|date_format:H:i',
            'sunday_hours' => 'required|in:Closed,Opened', // Ensure valid Sunday option
        ]);

        try {
            // Concatenate times directly without parsing to avoid errors
            $weekday_hours = $request->weekday_start . ' - ' . $request->weekday_end;
            $saturday_hours = $request->saturday_start . ' - ' . $request->saturday_end;

            // Find the OpenHour record and update fields
            $openHours = OpenHour::first();
            $openHours->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'description' => $request->description,
                'weekday_hours' => $weekday_hours,    // Save as string "09:00 - 18:00"
                'saturday_hours' => $saturday_hours,  // Save as string "09:00 - 18:00"
                'sunday_hours' => $request->sunday_hours, // Closed or Opened
            ]);

            return redirect()->route('openhours.index')->with('success', 'Open hours updated successfully.');
        } catch (\Exception $e) {
            // Return error message on exception
            return redirect()->back()->with('error', 'An error occurred while processing the open hours.');
        }
    }



}