<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\Appointment; // Add the Appointment model
use App\Models\OpenHour;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        // Fetch all services and service types
        $services = Service::all();
        $serviceTypes = ServiceType::all();

        // Fetch the open hours data from the database
        $openHours = OpenHour::first();

        return view('pages.appointment', compact('services', 'serviceTypes', 'openHours'));
    }

    public function store(Request $request)
    {
        // Validate the appointment form without 'email' (as it’s hidden and predefined)
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'service_id' => 'required|exists:services,id',
            'service_type_id' => 'required|exists:service_types,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        // Use the default email instead of user's email input
        $email = 'alcobraclient@gmail.com';

        // Save the appointment details to the database
        Appointment::create([
            'name' => $request->name,
            'email' => $email, // Use default email
            'phone' => $request->phone,
            'service_id' => $request->service_id,
            'servicetype_id' => $request->service_type_id, // Save selected service type
            'date' => $request->date,
            'time' => $request->time,
        ]);

        // Create WhatsApp message content
        $service = Service::find($request->service_id);
        $serviceType = ServiceType::find($request->service_type_id);

        $message = urlencode(
            "📅 *New Appointment Request* \n\n" .
            "👤 *Client Details:* \n" .
            "   - *Name:* {$request->name} \n" .
            "   - *Phone:* {$request->phone} \n" .
            "   - *Email:* {$email} \n\n" .

            "🛎 *Service Information:* \n" .
            "   - *Service:* {$service->name} \n" .
            "   - *Service Type:* {$serviceType->name} \n" .
            "   - *Price:* " . number_format($serviceType->price, 0) . " FRW \n\n" .

            "📆 *Appointment Date & Time:* \n" .
            "   - *Date:* " . date('d-m-Y', strtotime($request->date)) . " \n" .
            "   - *Time:* " . date('H:i', strtotime($request->time)) . " \n\n" .

            "Thank you for your request! We will confirm your appointment shortly."
        );

        // Create WhatsApp link
        $whatsappLink = "https://wa.me/250784635535?text={$message}";


        // Redirect to WhatsApp
        return redirect($whatsappLink);
    }

}