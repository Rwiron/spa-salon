@extends('admin.layouts.master')

@section('title', 'Add New Team Member')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Add New Team Member</h3>
        <a href="{{ route('team.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Team Members
        </a>
    </div>

    <div class="page-header">
        <div class="card shadow-sm p-4">
            <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data" id="teamForm">
                @csrf

                <div class="row">
                    <!-- Name Input -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Enter full name" required>
                        </div>
                    </div>

                    <!-- Position Input -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="position" class="font-weight-bold">Position</label>
                            <input type="text" name="position" id="position" class="form-control"
                                placeholder="Enter position" required>
                        </div>
                    </div>
                </div>

                <h5 class="mt-4">Social Media Links (Optional)</h5>
                <div class="row">
                    <!-- Facebook Link -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="facebook_link" class="font-weight-bold">Facebook URL</label>
                            <input type="url" name="facebook_link" id="facebook_link" class="form-control"
                                placeholder="Enter Facebook URL">
                        </div>
                    </div>

                    <!-- Twitter Link -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="twitter_link" class="font-weight-bold">Twitter URL</label>
                            <input type="url" name="twitter_link" id="twitter_link" class="form-control"
                                placeholder="Enter Twitter URL">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- LinkedIn Link -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="linkedin_link" class="font-weight-bold">LinkedIn URL</label>
                            <input type="url" name="linkedin_link" id="linkedin_link" class="form-control"
                                placeholder="Enter LinkedIn URL">
                        </div>
                    </div>

                    <!-- Instagram Link -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="instagram_link" class="font-weight-bold">Instagram URL</label>
                            <input type="url" name="instagram_link" id="instagram_link" class="form-control"
                                placeholder="Enter Instagram URL">
                        </div>
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <label for="image" class="font-weight-bold">Profile Image</label>
                    <input type="file" name="image" id="image" class="form-control-file"
                        onchange="previewImage(event)">
                    <small class="form-text text-muted">Upload a profile image (optional).</small>

                    <!-- Preview Image -->
                    <div class="mt-3">
                        <img id="imagePreview" src="#" alt="Image Preview" style="display:none; width: 150px;">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button type="submit" class="btn btn-primary mt-3" style="width: 200px;">
                        <i class="fas fa-save"></i> Add Team Member
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image Preview Script
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function() {
                var imagePreview = document.getElementById('imagePreview');
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block'; // Show the image preview
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
