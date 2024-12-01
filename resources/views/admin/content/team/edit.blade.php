@extends('admin.layouts.master')

@section('title', 'Edit Team Member')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Edit Team Member</h3>
        <a href="{{ route('team.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Team Members
        </a>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <form action="{{ route('team.update', $team->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Name and Position side by side -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $team->name }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" name="position" id="position" class="form-control"
                                value="{{ $team->position }}" required>
                        </div>
                    </div>
                </div>

                <!-- Social Links Section -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="facebook_link">Facebook URL</label>
                            <input type="url" name="facebook_link" id="facebook_link" class="form-control"
                                value="{{ $team->facebook_link }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="twitter_link">Twitter URL</label>
                            <input type="url" name="twitter_link" id="twitter_link" class="form-control"
                                value="{{ $team->twitter_link }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="linkedin_link">LinkedIn URL</label>
                            <input type="url" name="linkedin_link" id="linkedin_link" class="form-control"
                                value="{{ $team->linkedin_link }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="instagram_link">Instagram URL</label>
                            <input type="url" name="instagram_link" id="instagram_link" class="form-control"
                                value="{{ $team->instagram_link }}">
                        </div>
                    </div>
                </div>

                <!-- Image Upload Section -->
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if ($team->image)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}" width="100"
                                height="100" class="img-fluid" style="border-radius: 50%; object-fit: cover;">
                        </div>
                    @else
                        <p class="text-muted mt-2">No image uploaded</p>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Team Member
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
