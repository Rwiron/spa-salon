@extends('layout.master')

@section('title', $provide->title)

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
            <div class="col-lg-6">
                <img class="img-fluid" src="{{ asset('storage/' . $provide->image_path) }}" alt="{{ $provide->title }}">
            </div>
            <div class="col-lg-6">
                <h1>{{ $provide->title }}</h1>
                <h4>{{ $provide->subtitle }}</h4>
                <p>{{ $provide->description }}</p>
                <a href="{{ route('client.provide.index') }}" class="btn btn-primary">Back to Services</a>
            </div>
        </div>
    </div>
@endsection
s
