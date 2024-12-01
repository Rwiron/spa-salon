@extends('admin.layouts.master')

@section('title', 'Add New Tariff')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add New Tariff</h3>
        <a href="{{ route('tariffs.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Tariffs
        </a>
    </div>

    <div class="page-header">
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('tariffs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Tariff Name -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Tariff Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Enter tariff name" required>
                        </div>

                        <!-- Available At -->
                        <div class="col-md-6 mb-3">
                            <label for="available_at" class="form-label">Available At</label>
                            <input type="date" name="available_at" id="available_at" class="form-control"
                                placeholder="Select availability date">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Description -->
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4"
                                placeholder="Enter a brief description" required></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Expires At -->
                        <div class="col-md-6 mb-3">
                            <label for="expires_at" class="form-label">Expires At</label>
                            <input type="date" name="expires_at" id="expires_at" class="form-control"
                                placeholder="Select expiration date">
                        </div>

                        <!-- File Upload (PDF only) -->
                        <div class="col-md-6 mb-3">
                            <label for="file" class="form-label">Upload Tariff File (PDF only)</label>
                            <input type="file" name="file" id="file" class="form-control"
                                accept="application/pdf" required>
                            <small class="text-muted">Only PDF files are allowed.</small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-upload"></i> Add Tariff
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
