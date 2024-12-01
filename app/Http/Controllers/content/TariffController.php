<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TariffController extends Controller
{
    public function index()
    {
        $tariffs = Tariff::all();
        return view('admin.content.tariffs.index', compact('tariffs'));
    }

    public function create()
    {
        return view('admin.content.tariffs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'available_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
            'file' => 'required|file|mimes:pdf', // Restricting to certain file types
        ]);

        // Store the uploaded file and get its path
        $filePath = $request->file('file')->store('tariffs', 'public');

        Tariff::create([
            'name' => $request->name,
            'description' => $request->description,
            'available_at' => $request->available_at,
            'expires_at' => $request->expires_at,
            'file_path' => $filePath,
        ]);

        return redirect()->route('tariffs.index')->with('success', 'Tariff uploaded successfully.');
    }

    public function destroy($id)
    {
        $tariff = Tariff::findOrFail($id);

        // Delete the file from storage
        Storage::disk('public')->delete($tariff->file_path);

        $tariff->delete();

        return redirect()->route('tariffs.index')->with('success', 'Tariff deleted successfully.');
    }

    // If you need to edit a tariff
    public function edit($id)
    {
        $tariff = Tariff::findOrFail($id);
        return view('admin.content.tariffs.edit', compact('tariff'));
    }

    public function update(Request $request, $id)
    {
        $tariff = Tariff::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'available_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
            'file' => 'nullable|file|mimes:pdf,docx,xlsx',
        ]);

        // Check if a new file is uploaded
        if ($request->hasFile('file')) {
            // Delete the old file
            Storage::disk('public')->delete($tariff->file_path);

            // Store the new file
            $filePath = $request->file('file')->store('tariffs', 'public');
            $tariff->file_path = $filePath;
        }

        $tariff->update([
            'name' => $request->name,
            'description' => $request->description,
            'available_at' => $request->available_at,
            'expires_at' => $request->expires_at,
        ]);

        return redirect()->route('tariffs.index')->with('success', 'Tariff updated successfully.');
    }
}
