@extends('admin.layouts.master')

@section('title', 'Manage Open Hours')

@section('content')
    <div class="page-header">
        <h3>Manage Open Hours</h3>
        <a href="{{ route('openhours.edit') }}" class="btn btn-primary">Edit Open Hours</a>
    </div>

    <div class="container mt-4">
        @if ($openHours)
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">{{ $openHours->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $openHours->subtitle }}</h6>
                    <p class="card-text">{{ $openHours->description }}</p>
                    <p><strong>Weekday Hours: </strong> {{ $openHours->weekday_hours }}</p>
                    <p><strong>Saturday Hours: </strong> {{ $openHours->saturday_hours }}</p>
                    <p><strong>Sunday Hours: </strong> {{ $openHours->sunday_hours }}</p>

                    @if ($openHours->image_path)
                        <img src="{{ asset('storage/' . $openHours->image_path) }}" alt="Open Hours Image" width="300"
                            class="img-fluid mt-3">
                    @endif
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                No open hours content is available. Please <a href="{{ route('openhours.edit') }}">create or edit</a> the
                content.
            </div>
        @endif
    </div>
@endsection
