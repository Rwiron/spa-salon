<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    // Show all appointments
    public function index()
    {
        $appointments = Appointment::all();
        return view('admin.appointments.index', compact('appointments'));
    }

    // Show form to create a new appointment
    public function create()
    {
        return view('admin.appointments.create');
    }

    // Store a newly created appointment
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        Appointment::create([
            'client_name' => $request->client_name,
            'service' => $request->service,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    // Show form to edit an appointment
    public function edit(Appointment $appointment)
    {
        return view('admin.appointments.edit', compact('appointment'));
    }

    // Update an appointment
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $appointment->update([
            'client_name' => $request->client_name,
            'service' => $request->service,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    // Delete an appointment
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}