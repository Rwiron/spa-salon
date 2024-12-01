@extends('layout.master')

@section('about', 'Home - Alcobra Dubai Kigali_Salon and Spa')

@section('content')

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid bg-jumbotron" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h3 class="text-white display-3 mb-4">About</h3>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="">Home</a></p>
                <i class="far fa-circle px-3"></i>
                <p class="m-0">About</p>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 pb-5 pb-lg-0">
                    @if ($about && $about->image_path)
                        <img class="img-fluid w-100" src="{{ asset('storage/' . $about->image_path) }}" alt="About Image">
                    @else
                        <img class="img-fluid w-100" src="img/default-about.jpg" alt="About Default Image">
                    @endif
                </div>
                <div class="col-lg-6">
                    <h6 class="d-inline-block text-primary text-uppercase bg-light py-1 px-2">About Us</h6>
                    <h1 class="mb-4">{{ $about->title ?? 'Your Best Spa, Beauty & Skin Care Center' }}</h1>
                    <p class="pl-4 border-left border-primary">
                        {{ $about->description ?? 'Default about description goes here. Edit to customize.' }}</p>
                    <div class="row pt-3">
                        <div class="col-6">
                            <div class="bg-light text-center p-4">
                                <h3 class="display-4 text-primary" data-toggle="counter-up">
                                    {{ $about->spa_specialists_count ?? 0 }}</h3>
                                <h6 class="text-uppercase">Spa Specialist</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-light text-center p-4">
                                <h3 class="display-4 text-primary" data-toggle="counter-up">
                                    {{ $about->happy_clients_count ?? 0 }}</h3>
                                <h6 class="text-uppercase">Happy Clients</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6">
                    <h6 class="d-inline-block bg-light text-primary text-uppercase py-1 px-2">Spa Specialist</h6>
                    <h1 class="mb-5">Spa & Beauty Specialist</h1>
                </div>
            </div>
            <div class="row">
                @foreach ($teams as $team)
                    <div class="col-lg-3 col-md-6">
                        <div class="team position-relative overflow-hidden mb-5">
                            <img class="img-fluid" src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}">
                            <div class="position-relative text-center">
                                <div class="team-text bg-primary text-white">
                                    <h5 class="text-white text-uppercase">{{ $team->name }}</h5>
                                    <p class="m-0">{{ $team->position }}</p>
                                </div>
                                <div class="team-social bg-dark text-center">
                                    @if ($team->twitter_link)
                                        <a class="btn btn-outline-primary btn-square mr-2"
                                            href="{{ $team->twitter_link }}"><i class="fab fa-twitter"></i></a>
                                    @endif
                                    @if ($team->facebook_link)
                                        <a class="btn btn-outline-primary btn-square mr-2"
                                            href="{{ $team->facebook_link }}"><i class="fab fa-facebook-f"></i></a>
                                    @endif
                                    @if ($team->linkedin_link)
                                        <a class="btn btn-outline-primary btn-square mr-2"
                                            href="{{ $team->linkedin_link }}"><i class="fab fa-linkedin-in"></i></a>
                                    @endif
                                    @if ($team->instagram_link)
                                        <a class="btn btn-outline-primary btn-square" href="{{ $team->instagram_link }}"><i
                                                class="fab fa-instagram"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->
@endsection
