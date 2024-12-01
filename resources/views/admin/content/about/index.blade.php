@extends('admin.layouts.master')

@section('title', 'About Section')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>About Section Overview</h3>
        <a href="{{ route('about.edit') }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit About Section
        </a>
    </div>

    <div class="container mt-4">
        @if ($about)
            <div class="card shadow-lg border-0">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        @if ($about->image_path)
                            <img src="{{ asset('storage/' . $about->image_path) }}" alt="About Image"
                                class="img-fluid rounded-left" style="height: 100%; object-fit: cover;">
                        @else
                            <img src="{{ asset('img/default-about.jpg') }}" alt="Default Image"
                                class="img-fluid rounded-left" style="height: 100%; object-fit: cover;">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $about->title }}</h5>
                            <h6 class="card-subtitle text-muted mb-3">{{ $about->subtitle }}</h6>
                            <p class="card-text">{{ $about->description }}</p>
                            <div class="d-flex justify-content-between mt-4">
                                <div class="text-center">
                                    <h4 class="text-primary">{{ $about->spa_specialists_count }}</h4>
                                    <p>Spa Specialists</p>
                                </div>
                                <div class="text-center">
                                    <h4 class="text-primary">{{ $about->happy_clients_count }}</h4>
                                    <p>Happy Clients</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning mt-4">
                <strong>No About section content is available.</strong> Please
                <a href="{{ route('about.edit') }}" class="alert-link">create or edit</a> the content.
            </div>
        @endif
    </div>
@endsection
