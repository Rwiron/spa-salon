<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Models\AppointmentDeal;
use Illuminate\Http\Request;
use PDF; // You can use a package like DomPDF or any other PDF package

class AcceptedAppointmentController extends Controller
{
    // Display only accepted appointments
    public function index(Request $request)
    {
        // Query based on search parameters
        $query = AppointmentDeal::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('time')) {
            $query->where('time', $request->time);
        }

        $acceptedAppointments = $query->with(['service', 'serviceType'])->paginate(1000);

        // Count total accepted appointments
        $totalAcceptedAppointments = AppointmentDeal::count();

        return view('admin.appointments.accepted', compact('acceptedAppointments', 'totalAcceptedAppointments'));
    }

    // Generate Report
    public function generateReport()
    {
        // Get all accepted appointments
        $acceptedAppointments = AppointmentDeal::with(['service', 'serviceType'])->get();

        // Generate PDF (using DomPDF for example)
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.appointments.report', compact('acceptedAppointments'));

        // Return PDF for download
        return $pdf->download('accepted_appointments_report.pdf');
    }
}