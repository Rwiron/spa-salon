@extends('admin.layouts.master')

@section('title', 'Manage Home Content')

@section('content')
    <div class="container-fluid py-5">
        <div class="card">
            <div class="card-header">
                <h3>Manage Home Content</h3>
            </div>
            <div class="card-body">
                <!-- Show success message if any -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Form to update the home content -->
                <form action="{{ route('homecontent.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Carousel Text 1 -->
                    <div class="form-group">
                        <label for="carousel_text_1">Carousel Text 1</label>
                        <input type="text" name="carousel_text_1" id="carousel_text_1" class="form-control"
                            value="{{ $homeContent->carousel_text_1 ?? '' }}" required>
                    </div>

                    <!-- Carousel Text 2 -->
                    <div class="form-group">
                        <label for="carousel_text_2">Carousel Text 2</label>
                        <input type="text" name="carousel_text_2" id="carousel_text_2" class="form-control"
                            value="{{ $homeContent->carousel_text_2 ?? '' }}" required>
                    </div>

                    <!-- Carousel Image 1 -->
                    <div class="form-group">
                        <label for="carousel_image_1">Carousel Image 1</label>
                        <input type="file" name="carousel_image_1" id="carousel_image_1" class="form-control">
                    </div>

                    <!-- About Us Section -->
                    <h4>About Us Section</h4>
                    <div class="form-group">
                        <label for="about_us_title">Title</label>
                        <input type="text" name="about_us_title" id="about_us_title" class="form-control"
                            value="{{ $homeContent->about_us_title ?? '' }}" required>
                    </div>

                    <div class="form-group">
                        <label for="about_us_description">Description</label>
                        <textarea name="about_us_description" id="about_us_description" class="form-control" rows="4" required>{{ $homeContent->about_us_description ?? '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="about_us_image">About Us Image</label>
                        <input type="file" name="about_us_image" id="about_us_image" class="form-control">
                    </div>

                    <!-- Save Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
