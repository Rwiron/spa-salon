<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Gallery; // Assuming you have a Gallery model

class GalleryController extends Controller
{
    public function index()
    {
        // Fetch all gallery images
        $galleries = Gallery::all();

        // Render the gallery page and pass the images
        return view('pages.gallery', compact('galleries'));
    }
}