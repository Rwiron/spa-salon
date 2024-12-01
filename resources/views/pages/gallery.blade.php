@extends('layout.master')

@section('title', 'Gallery - Alcobra Dubai Kigali_Salon and Spa')

@section('content')
    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid bg-jumbotron" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h3 class="text-white display-3 mb-4">Gallery</h3>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="{{ route('home') }}">Home</a></p>
                <i class="far fa-circle px-3"></i>
                <p class="m-0">Gallery</p>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Gallery Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                @if ($galleries->isEmpty())
                    <div class="col-12 text-center">
                        <h4 class="text-muted">No gallery images available at the moment.</h4>
                    </div>
                @else
                    <!-- Loop through gallery images dynamically -->
                    @foreach ($galleries as $gallery)
                        <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                            <div class="card shadow-sm border-0">
                                <div class="card-img-container position-relative">
                                    <img src="{{ asset('storage/' . $gallery->image_path) }}" class="card-img-top img-fluid"
                                        alt="{{ $gallery->title }}">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $gallery->title }}</h5>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#galleryModal{{ $gallery->id }}">
                                        More Info
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for More Info -->
                        <div class="modal fade" id="galleryModal{{ $gallery->id }}" tabindex="-1"
                            aria-labelledby="galleryModalLabel{{ $gallery->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="galleryModalLabel{{ $gallery->id }}">
                                            {{ $gallery->title }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ asset('storage/' . $gallery->image_path) }}" class="img-fluid mb-3"
                                            alt="{{ $gallery->title }}">
                                        <p>{{ $gallery->description }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- Gallery End -->

    <style>
        .card-img-container {
            overflow: hidden;
            height: 300px;
            /* Ensures all images have the same height */
            position: relative;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures the image covers the container without distorting */
        }

        .card {
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-body img {
            width: 100%;
            /* Ensure the image in the modal is responsive */
            height: auto;
        }
    </style>
@endsection
