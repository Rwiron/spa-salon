<?php

namespace App\Http\Controllers\Customerss;

use App\Http\Controllers\Controller;

class CustomerDashboardController extends Controller
{
    /**
     * Show the dashboard for Customers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.customer.customer');
    }
}