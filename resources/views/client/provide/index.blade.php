@extends('layout.master')

@section('title', 'Our Services')

@section('content')
    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid bg-jumbotron" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h3 class="text-white display-3 mb-4">Services</h3>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="">Home</a></p>
                <i class="far fa-circle px-3"></i>
                <p class="m-0">Services</p>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <div class="container py-5">
        <div class="row">
            @foreach ($provides as $provide)
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <img class="card-img-top" src="{{ asset('storage/' . $provide->image_path) }}"
                            alt="{{ $provide->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $provide->title }}</h5>
                            <p class="card-text">{{ Str::limit($provide->description, 100) }}</p>
                            <a href="{{ route('client.provide.show', $provide->id) }}" class="btn btn-primary">View More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
