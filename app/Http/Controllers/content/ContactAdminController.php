<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactAdminController extends Controller
{
    // Display all contact messages
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.content.contacts.index', compact('contacts'));
    }

    // Delete a contact message
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact message deleted successfully.');
    }

    // Bulk delete contact messages
    // Bulk delete selected contacts
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids; // Get the array of selected IDs
        if ($ids && count($ids) > 0) {
            Contact::whereIn('id', $ids)->delete(); // Delete all the selected IDs
            return response()->json(['success' => true, 'message' => 'Selected contacts deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'No contacts selected for deletion.']);
    }
}
