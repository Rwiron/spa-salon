<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentStatusMail;
use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Mail;

class AppointController extends Controller
{
    // Display all appointments
    public function index(Request $request)
    {
        // Initialize the query and eager load 'service' and 'serviceType'
        $query = Appointment::with(['service', 'serviceType']);

        // Count all appointments (which are all pending by default)
        $pendingAppointmentsCount = Appointment::count();

        // Apply search filters
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }
        if ($request->filled('time')) {
            $query->where('time', $request->time);
        }

        // Paginate results and keep search filters in pagination links
        $appointments = $query->paginate(5)->appends($request->except('page'));

        return view('admin.appointments.index', compact('appointments', 'pendingAppointmentsCount'));
    }


    // Show form to create a new appointment

    public function create()
    {
        $services = Service::all();  // Fetch all services
        $serviceTypes = ServiceType::all();  // Fetch all service types
        return view('admin.appointments.create', compact('services', 'serviceTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15',
            'service_id' => 'required|exists:services,id',
            'service_type_id' => 'required|exists:service_types,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        // Save the appointment to the database
        $appointment = Appointment::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,  // Save phone number
            'service_id' => $request->service_id,
            'servicetype_id' => $request->service_type_id,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        // Create the WhatsApp message
        $message = urlencode("New Appointment Request:\n\n" .
            "Client: {$appointment->name}\n" .
            "Email: {$appointment->email}\n" .
            "Phone: {$appointment->phone}\n" .
            "Service: {$appointment->service->name}\n" .
            "Service Type: {$appointment->serviceType->name}\n" .
            "Price: " . number_format($appointment->serviceType->price, 0) . " FRW\n" .
            "Date: {$appointment->date}\n" .
            "Time: {$appointment->time}");

        // Create WhatsApp link
        $whatsappLink = "https://wa.me/250784635535?text={$message}";
        // Redirect to WhatsApp
        return redirect($whatsappLink);
    }




    // Handle the AJAX request to fetch service types
    public function getServiceTypes($serviceId)
    {
        $serviceTypes = ServiceType::where('service_id', $serviceId)->get();
        return response()->json(['serviceTypes' => $serviceTypes]);
    }
    // Show form to edit an appointment
    public function edit(Appointment $appointment)
    {
        // Fetch all services and service types for the dropdown
        $services = Service::all();
        $serviceTypes = ServiceType::where('service_id', $appointment->service_id)->get(); // Fetch types for selected service

        return view('admin.appointments.edit', compact('appointment', 'services', 'serviceTypes'));
    }

    // Update an appointment
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15', // Added phone validation
            'service_id' => 'required|exists:services,id',
            'servicetype_id' => 'required|exists:service_types,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $appointment->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,  // Store phone number
            'service_id' => $request->service_id,
            'servicetype_id' => $request->servicetype_id,
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


    public function accept($id)
    {
        // Fetch the appointment
        $appointment = Appointment::findOrFail($id);

        // Move the appointment to the appointment_deals table
        \DB::table('appointment_deals')->insert([
            'name' => $appointment->name,
            'email' => $appointment->email,
            'phone' => $appointment->phone, // Add phone number
            'service_id' => $appointment->service_id,
            'servicetype_id' => $appointment->servicetype_id,
            'date' => $appointment->date,
            'time' => $appointment->time,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Prepare the WhatsApp message content
        $message = urlencode("📅 *New Appointment Request* 📅\n\n" .
            "*Client Name:* {$appointment->name}\n" .
            "*Email:* {$appointment->email}\n" .
            "*Phone:* {$appointment->phone}\n" .
            "*Service:* {$appointment->service->name}\n" .
            "*Service Type:* {$appointment->serviceType->name}\n" .
            "*Date:* {$appointment->date}\n" .
            "*Time:* {$appointment->time}");

        // Create the WhatsApp link
        $whatsappLink = "https://wa.me/250784635535?text=$message";

        // Delete the appointment from the appointments table
        $appointment->delete();

        // Redirect back with success message and WhatsApp link
        return redirect()->route('appointments.index')->with('success', "
        <strong>Appointment Accepted!</strong><br>
        Client: <strong>{$appointment->name}</strong><br>
        Service: <strong>{$appointment->service->name}</strong> - {$appointment->serviceType->name}<br>
        Date: <strong>{$appointment->date}</strong><br>
        Time: <strong>{$appointment->time}</strong><br>
        <a href='$whatsappLink' target='_blank' class='btn btn-success mt-2'>
            <i class='bi bi-whatsapp'></i> Send WhatsApp Message
        </a>
    ");
    }





    public function decline($id)
    {
        $appointment = Appointment::findOrFail($id);

        // Prepare the WhatsApp message content for declining the appointment
        $message = urlencode("Dear {$appointment->name},\n\nWe regret to inform you that your appointment for the following service has been declined:\n\n- Service: {$appointment->service->name}\n- Service Type: {$appointment->serviceType->name}\n- Date: {$appointment->date}\n- Time: {$appointment->time}\n\nPlease feel free to contact us for further assistance.");

        // Create the WhatsApp link for decline notification
        $whatsappLink = "https://wa.me/250784635535?text=$message";

        // Delete the appointment from the appointments table
        $appointment->delete();

        // Return success message with WhatsApp link
        return redirect()->route('appointments.index')->with('success', "Appointment declined. WhatsApp message sent: <a href='$whatsappLink' target='_blank'>Send WhatsApp Message</a>");
    }





}