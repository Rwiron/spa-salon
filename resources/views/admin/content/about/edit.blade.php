@extends('admin.layouts.master')

@section('title', 'Edit About Section')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Edit About Section</h3>
        <a href="{{ route('about.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="col-lg-12">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ $about ? $about->title : '' }}" required>
                    </div>

                    <!-- Subtitle -->
                    <div class="form-group">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" name="subtitle" id="subtitle" class="form-control"
                            value="{{ $about ? $about->subtitle : '' }}" required>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required>{{ $about ? $about->description : '' }}</textarea>
                    </div>

                    <!-- Spa Specialists Count -->
                    <div class="form-group">
                        <label for="spa_specialists_count">Spa Specialists Count</label>
                        <input type="number" name="spa_specialists_count" id="spa_specialists_count" class="form-control"
                            value="{{ $about ? $about->spa_specialists_count : '' }}" required>
                    </div>

                    <!-- Happy Clients Count -->
                    <div class="form-group">
                        <label for="happy_clients_count">Happy Clients Count</label>
                        <input type="number" name="happy_clients_count" id="happy_clients_count" class="form-control"
                            value="{{ $about ? $about->happy_clients_count : '' }}" required>
                    </div>

                    <!-- About Image -->
                    <div class="form-group">
                        <label for="image">About Image (optional)</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <small class="form-text text-muted">Leave blank if you don't want to update the image.</small>
                        <br>
                        @if ($about && $about->image_path)
                            <img src="{{ asset('storage/' . $about->image_path) }}" alt="About Image" class="img-thumbnail"
                                width="200">
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update About Section
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
