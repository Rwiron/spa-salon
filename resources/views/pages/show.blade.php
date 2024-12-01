@extends('layout.master')

@section('title', $provide->title)

@section('content')
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
