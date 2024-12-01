@extends('admin.layouts.master')

@section('title', 'Create Carousel Item')

@section('content')
    <!-- Page Header -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Create New Carousel Item</h3>
        <a href="{{ route('home.carousel.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Carousel List
        </a>
    </div>

    <!-- Form to Create Carousel Item -->
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <form action="{{ route('home.carousel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Title Input -->
                <div class="form-group">
                    <label for="title" class="font-weight-bold">Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                        placeholder="Enter carousel title" required>
                </div>

                <!-- Subtitle Input -->
                <div class="form-group">
                    <label for="subtitle" class="font-weight-bold">Subtitle</label>
                    <input type="text" name="subtitle" id="subtitle" class="form-control"
                        placeholder="Enter carousel subtitle" required>
                </div>

                <!-- Description Textarea -->
                <div class="form-group">
                    <label for="description" class="font-weight-bold">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4"
                        placeholder="Enter a brief description" required></textarea>
                </div>

                <!-- Image Upload with Dotted Border and Preview -->
                <div class="form-group">
                    <label for="image" class="font-weight-bold">Image</label>
                    <div class="dotted-border-upload" id="dotted-border-upload">
                        <input type="file" name="image" id="image" class="form-control-file" required
                            onchange="previewImage(event)">
                        <span class="upload-placeholder text-muted" id="upload-placeholder">
                            <i class="fas fa-upload"></i> Choose an image to upload (jpeg, png, jpg, gif)
                        </span>
                    </div>
                    <img id="image-preview" src="" alt="Preview" class="img-fluid mt-3 d-none"
                        style="width: 100%; height: 100%; object-fit: cover;">
                    <small class="form-text text-muted">Recommended size: 1920x1080px.</small>
                </div>

                <!-- Submit Button -->
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Carousel Item
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript to Preview Image and Hide Placeholder/Dotted Border -->
    <script>
        function previewImage(event) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('upload-placeholder');
            const dottedBorder = document.getElementById('dotted-border-upload');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none'); // Show image preview
                    placeholder.style.display = 'none'; // Hide placeholder text
                    dottedBorder.style.display = 'none'; // Hide the dotted border after image selection
                };
                reader.readAsDataURL(file); // Convert the image to a data URL
            }
        }
    </script>

    <!-- Updated Styling for Dotted Border and Responsive Preview -->
    <style>
        
    </style>
@endsection
