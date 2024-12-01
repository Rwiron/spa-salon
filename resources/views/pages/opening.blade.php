@extends('layout.master')

@section('opening', 'Home - Alcobra Dubai Kigali_Salon and Spa')

@section('content')

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid bg-jumbotron" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h3 class="text-white display-3 mb-4">Open Hours</h1>
                <div class="d-inline-flex align-items-center text-white">
                    <p class="m-0"><a class="text-white" href="">Home</a></p>
                    <i class="far fa-circle px-3"></i>
                    <p class="m-0">Open Hours</p>
                </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Open Hours Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <!-- Make the image dynamic -->
                        @if ($openHours && $openHours->image_path)
                            <img class="position-absolute w-100 h-100"
                                src="{{ asset('storage/' . $openHours->image_path) }}" style="object-fit: cover;"
                                alt="Opening Hours">
                        @else
                            <img class="position-absolute w-100 h-100" src="{{ asset('img/default-opening.jpg') }}"
                                style="object-fit: cover;" alt="Opening Hours">
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="hours-text bg-light p-4 p-lg-5 my-lg-5">
                        <!-- Dynamic title and subtitle -->
                        <h6 class="d-inline-block text-white text-uppercase bg-primary py-1 px-2">
                            {{ $openHours->subtitle ?? 'Open Hours' }}</h6>
                        <h1 class="mb-4">{{ $openHours->title ?? 'Best Relax And Spa Zone' }}</h1>

                        <!-- Dynamic description -->
                        <p>{{ $openHours->description ?? 'Enjoy our relaxing and calming spa services in a serene environment.' }}
                        </p>

                        <!-- Dynamic open hours -->
                        <ul class="list-inline">
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Mon – Fri :
                                {{ $openHours->weekday_hours ?? '9:00 AM - 7:00 PM' }}</li>
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Saturday :
                                {{ $openHours->saturday_hours ?? '9:00 AM - 6:00 PM' }}</li>
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Sunday :
                                {{ $openHours->sunday_hours ?? 'Closed' }}</li>
                        </ul>

                        <a href="{{ route('appointment.index') }}" class="btn btn-primary mt-2">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Open Hours End -->


@endsection
