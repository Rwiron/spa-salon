<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentDeal;
use App\Models\Service;
use App\Models\User;
use App\Models\Gallery;
use App\Models\ServiceType;
use App\Models\Team;
use App\Models\PricingPlan;
use App\Models\Appointment;



class SuperAdminController extends Controller
{
    /**
     * Show the dashboard for Super Admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get counts from the database
        $totalServices = Service::count();
        $acceptedAppointments = AppointmentDeal::count(); // Assuming 'status' column exists
        $totalUsers = User::count();
        $totalGalleries = Gallery::count();
        $ServiceType = ServiceType::count();
        $team = Team::count();
        $pricingPlan = PricingPlan::count();
        $appoint = Appointment::count();

        return view('admin.superadmin.superadmin', compact('totalServices', 'acceptedAppointments', 'totalUsers', 'totalGalleries', 'ServiceType', 'team', 'pricingPlan','appoint'));
    }
}