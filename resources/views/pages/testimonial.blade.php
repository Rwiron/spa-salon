@extends('layout.master')

@section('testimonial', 'Home - Alcobra Dubai Kigali_Salon and Spa')

@section('content')
    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid bg-jumbotron" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h3 class="text-white display-3 mb-4">Testimonial</h3>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="">Home</a></p>
                <i class="far fa-circle px-3"></i>
                <p class="m-0">Testimonial</p>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 pb-5 pb-lg-0">
                    <img class="img-fluid w-100" src="{{ asset('img/testimonial.jpg') }}" alt="Testimonial">
                </div>
                <div class="col-lg-6">
                    <h6 class="d-inline-block text-primary text-uppercase bg-light py-1 px-2">Testimonial</h6>
                    <h1 class="mb-4">What Our Clients Say!</h1>
                    <div class="owl-carousel testimonial-carousel">
                        @foreach ($testimonials as $testimonial)
                            <div class="position-relative">
                                <i class="fa fa-3x fa-quote-right text-primary position-absolute"
                                    style="top: -6px; right: 0;"></i>
                                <div class="d-flex align-items-center mb-3">
                                    <img class="img-fluid rounded-circle"
                                        src="{{ asset('storage/' . $testimonial->image) }}"
                                        style="width: 60px; height: 60px;" alt="{{ $testimonial->client_name }}">
                                    <div class="ml-3">
                                        <h6 class="text-uppercase">{{ $testimonial->client_name }}</h6>
                                        <span>{{ $testimonial->profession }}</span>
                                    </div>
                                </div>
                                <p class="m-0">{{ $testimonial->testimonial }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

@endsection
