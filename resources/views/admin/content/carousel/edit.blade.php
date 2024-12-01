@extends('admin.layouts.master')

@section('title', 'Edit Carousel Item')

@section('content')
    <!-- Page Header -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Edit Carousel Item</h3>
        <a href="{{ route('home.carousel.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <!-- Form to Edit Carousel Item -->
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <form action="{{ route('home.carousel.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title Input -->
                <div class="form-group">
                    <label for="title" class="font-weight-bold">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $carousel->title }}"
                        placeholder="Enter carousel title" required>
                </div>

                <!-- Subtitle Input -->
                <div class="form-group">
                    <label for="subtitle" class="font-weight-bold">Subtitle</label>
                    <input type="text" name="subtitle" id="subtitle" class="form-control"
                        value="{{ $carousel->subtitle }}" placeholder="Enter carousel subtitle" required>
                </div>

                <!-- Description Textarea -->
                <div class="form-group">
                    <label for="description" class="font-weight-bold">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4"
                        placeholder="Enter a brief description" required>{{ $carousel->description }}</textarea>
                </div>

                <!-- Image Upload with Preview -->
                <div class="form-group">
                    <label for="image" class="font-weight-bold">Carousel Image (optional)</label>
                    <input type="file" name="image" id="image" class="form-control-file"
                        onchange="previewImage(event)">
                    <small class="form-text text-muted">Leave blank if you don't want to update the image. Recommended size:
                        1920x1080px.</small>

                    <!-- Display current image if exists -->
                    @if ($carousel->image_path)
                        <div class="mt-3">
                            <img id="current-image" src="{{ asset('storage/' . $carousel->image_path) }}"
                                alt="{{ $carousel->title }}" class="img-fluid rounded" style="max-width: 200px;">
                        </div>
                    @endif

                    <!-- Preview newly uploaded image -->
                    <div class="mt-3">
                        <img id="image-preview" src="" alt="Preview" class="img-fluid rounded d-none"
                            style="max-width: 200px;">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Carousel Item
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript to Preview Image -->
    <script>
        function previewImage(event) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            const preview = document.getElementById('image-preview');
            const currentImage = document.getElementById('current-image');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none'); // Show new image preview
                    currentImage.style.display = 'none'; // Hide current image when a new one is selected
                };
                reader.readAsDataURL(file); // Convert the image to a data URL
            }
        }
    </script>
@endsection
