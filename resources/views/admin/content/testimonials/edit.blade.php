@extends('admin.layouts.master')

@section('title', 'Edit Testimonial')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Edit Testimonial</h3>
        <a href="{{ route('testimonials.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Testimonials
        </a>
    </div>

    <div class="container mt-4">
        <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Client Name and Profession on the same row -->
                <div class="col-md-6 mb-3">
                    <label for="client_name">Client Name</label>
                    <input type="text" name="client_name" id="client_name" class="form-control"
                        value="{{ old('client_name', $testimonial->client_name) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="profession">Profession</label>
                    <input type="text" name="profession" id="profession" class="form-control"
                        value="{{ old('profession', $testimonial->profession) }}" required>
                </div>
            </div>

            <!-- Testimonial field -->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="testimonial">Testimonial</label>
                    <textarea name="testimonial" id="testimonial" class="form-control" rows="4" required>
                        {{ old('testimonial', $testimonial->testimonial) }}
                    </textarea>
                </div>
            </div>

            <!-- Image upload -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="image">Client Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if ($testimonial->image)
                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->client_name }}"
                            width="100" class="img-fluid mt-2" style="border-radius: 50%;">
                    @else
                        <p class="text-muted mt-2">No image uploaded</p>
                    @endif
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Testimonial
                </button>
            </div>
        </form>
    </div>
@endsection
