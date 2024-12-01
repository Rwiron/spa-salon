@extends('admin.layouts.master')

@section('title', 'Add New Testimonial')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Add New Testimonial</h3>
        <a href="{{ route('testimonials.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Testimonials
        </a>
    </div>

    <div class="container mt-4">
        <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Client Name and Profession on the same line -->
                <div class="col-md-6 mb-3">
                    <label for="client_name">Client Name</label>
                    <input type="text" name="client_name" id="client_name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="profession">Profession</label>
                    <input type="text" name="profession" id="profession" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <!-- Testimonial text area -->
                <div class="col-md-12 mb-3">
                    <label for="testimonial">Testimonial</label>
                    <textarea name="testimonial" id="testimonial" class="form-control" rows="4" required></textarea>
                </div>
            </div>

            <div class="row">
                <!-- Image upload -->
                <div class="col-md-6 mb-3">
                    <label for="image">Upload Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <small class="form-text text-muted">Optional. If no image is uploaded, a default will be used.</small>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Add Testimonial
                </button>
            </div>
        </form>
    </div>
@endsection
