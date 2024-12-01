@extends('layout.master')

@section('pricing', 'Home - Alcobra Dubai Kigali_Salon and Spa')

@section('content')

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid bg-jumbotron" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h3 class="text-white display-3 mb-4">Pricing</h3>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="">Home</a></p>
                <i class="far fa-circle px-3"></i>
                <p class="m-0">Pricing</p>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Pricing Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="{{ asset('img/pricing.jpg') }}"
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7 pt-5 pb-lg-5">
                    <div class="pricing-text bg-light p-4 p-lg-5 my-lg-5">
                        <div class="owl-carousel pricing-carousel">
                            @foreach ($pricingPlans as $plan)
                                <div class="bg-white d-flex flex-column" style="min-height: 400px;">
                                    <div class="d-flex align-items-center justify-content-between p-4"
                                        style="border-bottom: 2px solid #f1f1f1;">
                                        <div class="price-section">
                                            <h1 class="mb-0" style="font-size: 20px;">
                                                <small class="align-top text-muted font-weight-medium"
                                                    style="font-size: 16px; line-height: 22px;">RWF</small>
                                                {{ number_format($plan->price / 1000, 0) }}K
                                                <small class="align-bottom text-muted font-weight-medium"
                                                    style="font-size: 14px; line-height: 24px;">
                                                    /{{ $plan->duration }}
                                                </small>
                                            </h1>
                                        </div>

                                        <!-- Plan Title -->
                                        <div class="plan-title text-right">
                                            <h5 class="text-uppercase font-weight-bold"
                                                style="color: #F76C6C; font-size: 16px;">{{ $plan->title }}</h5>
                                        </div>
                                    </div>

                                    <!-- List Features -->
                                    <div class="p-4" style="flex-grow: 1;">
                                        @foreach ($plan->features as $feature)
                                            <p class="d-flex align-items-center" style="font-size: 14px;">
                                                <i class="fa fa-check text-success mr-2"></i>{{ $feature->feature }}
                                            </p>
                                        @endforeach
                                    </div>
{{--
                                    <!-- Order Button (Always at the bottom) -->
                                    <div class="p-4 text-center">
                                        <a href="" class="btn btn-primary"
                                            style="background-color: #F76C6C; border: none; width: 50%; margin: 0 auto;">Order
                                            Now</a>
                                    </div> --}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing End -->


    <!-- Tariff Section -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="{{ asset('img/opening.jpg') }}"
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="tariff-text bg-light p-4 p-lg-5 my-lg-5">
                        <h6 class="d-inline-block text-white text-uppercase bg-primary py-1 px-2">Tariffs</h6>
                        <h1 class="mb-4">Latest Tariff Plans</h1>
                        <p>Discover our best deals and services with our tariff plans. Click below to download or view the
                            details.</p>

                        <ul class="list-group">
                            @foreach ($tariffs as $tariff)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1">{{ $tariff->name }}</h5>
                                        <p class="mb-1">{{ Str::limit($tariff->description, 50) }}</p>
                                        <small>Available from:
                                            {{ \Carbon\Carbon::parse($tariff->available_at)->format('d M Y') }}</small><br>
                                        <small>Expires on:
                                            {{ \Carbon\Carbon::parse($tariff->expires_at)->format('d M Y') }}</small>
                                    </div>
                                    <a href="{{ asset('storage/' . $tariff->file_path) }}" class="btn btn-primary btn-sm"
                                        target="_blank">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tariff Section End -->

@endsection
