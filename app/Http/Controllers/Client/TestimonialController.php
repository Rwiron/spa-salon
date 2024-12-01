<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        // Fetch testimonials from the database
        $testimonials = Testimonial::all();

        // Pass testimonials to the view
        return view('pages.testimonial', compact('testimonials'));
    }
}