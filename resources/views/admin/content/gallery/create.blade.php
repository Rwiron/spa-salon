@extends('admin.layouts.master')

@section('title', 'Add New Gallery Image')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Add New Gallery Image</h3>
        <a href="{{ route('gallery.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Gallery
        </a>
    </div>

    <div class="page-header">
        <div class="card shadow-sm p-4">
            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Image Title -->
                <div class="form-group">
                    <label for="title" class="font-weight-bold">Image Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter image title"
                        required>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description" class="font-weight-bold">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter description"></textarea>
                </div>

                <!-- Image Upload with Preview -->
                <div class="form-group">
                    <label for="image" class="font-weight-bold">Upload Image</label>
                    <input type="file" name="image" id="image" class="form-control-file"
                        accept="image/jpeg,image/png,image/jpg" required onchange="previewImage(event)">
                    <small class="form-text text-muted">Only JPG, JPEG, and PNG formats are allowed.</small>

                    <!-- Image Preview -->
                    <div class="mt-3">
                        <img id="image-preview" src="#" alt="Image Preview"
                            style="max-width: 300px; display: none;" />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Add Image
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript to Preview Selected Image -->
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
