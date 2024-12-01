@extends('layout.master')

@section('title', 'Home - Alcobra Dubai Kigali_Salon and Spa')

@section('content')

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 pb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($carousels as $key => $carousel)
                    <li data-target="#header-carousel" data-slide-to="{{ $key }}"
                        class="{{ $key == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach ($carousels as $key => $carousel)
                    <div class="carousel-item position-relative {{ $key == 0 ? 'active' : '' }}" style="min-height: 100vh;">
                        <img class="position-absolute w-100 h-100" src="{{ asset('storage/' . $carousel->image_path) }}"
                            style="object-fit: cover;" alt="{{ $carousel->title }}">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown"
                                    style="letter-spacing: 3px;">{{ $carousel->title }}</h6>
                                <h3 class="display-3 text-capitalize text-white mb-3">{{ $carousel->subtitle }}</h3>
                                <p class="mx-md-5 px-5">{{ $carousel->description }}</p>
                                <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp"
                                    href="{{ url('/appointment') }}">Make Appointment</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Carousel End -->



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



    <!-- Service Start -->
    <div class="container-fluid px-0 py-5 my-5">
        <div class="row mx-0 justify-content-center text-center">
            <div class="col-lg-6">
                <h6 class="d-inline-block bg-light text-primary text-uppercase py-1 px-2">Our Service</h6>
                <h1>Spa & Beauty Services</h1>
            </div>
        </div>
        <div class="owl-carousel service-carousel">
            @foreach ($provides as $provide)
                <div class="service-item position-relative">
                    <img class="img-fluid" src="{{ asset('storage/' . $provide->image_path) }}"
                        alt="{{ $provide->title }}">
                    <div class="service-text text-center">
                        <h4 class="text-white font-weight-medium px-3">{{ $provide->title }}</h4>
                        <!-- Limit the description to 20 words -->
                        <p class="text-white px-3 mb-3">{{ Str::limit($provide->description, 100, '...') }}</p>
                        <div class="w-100 bg-white text-center p-4">
                            <!-- Link to detailed view page -->
                            <a class="btn btn-primary" href="{{ route('client.provide.show', $provide->id) }}">View
                                More</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center bg-appointment mx-0">
            <div class="col-lg-6 py-5">
                <div class="p-5 my-5 shadow-lg" style="background: rgba(33, 30, 28, 0.85); border-radius: 15px;">
                    <h1 class="text-white text-center mb-4">Make Appointment</h1>

                    <!-- Appointment Form -->
                    <form action="{{ route('appointment.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name" class="text-white">Your Name</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control bg-transparent p-4" placeholder="Your Name"
                                        required="required" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone" class="text-white">Your Phone</label>
                                    <input type="text" name="phone" id="phone"
                                        class="form-control bg-transparent p-4" placeholder="Your Phone"
                                        required="required" />
                                </div>
                            </div>
                        </div>

                        <!-- Hidden email input with default value -->
                        <input type="hidden" name="email" value="alcobraclient@gmail.com">

                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="service_id" class="text-white">Select A Service</label>
                                    <select name="service_id" id="service_id" class="custom-select bg-transparent px-4"
                                        required>
                                        <option value="">-- Select A Service --</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="service_type_id" class="text-white">Select A Service Type</label>
                                    <select name="service_type_id" id="service_type_id"
                                        class="custom-select bg-transparent px-4" required>
                                        <option value="">-- Select A Service Type --</option>
                                        <!-- Dynamic service types will be loaded here -->
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="date" class="text-white">Select Date</label>
                                    <input type="date" name="date" id="date"
                                        class="form-control bg-transparent p-4" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="time" class="text-white">Select Time</label>
                                    <input type="time" name="time" id="time"
                                        class="form-control bg-transparent p-4" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-row">

                        </div>

                        <div class="form-row">
                            <div class="col-sm-6">
                                <button class="btn btn-primary btn-block" type="submit" style="height: 47px;">Make
                                    Appointment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

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

                                    <!-- Order Button (Always at the bottom) -->
                                    {{-- <div class="p-4 text-center">
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
                            <img class="img-fluid" src="{{ asset('storage/' . $team->image) }}"
                                alt="{{ $team->name }}">
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
                                        <a class="btn btn-outline-primary btn-square"
                                            href="{{ $team->instagram_link }}"><i class="fab fa-instagram"></i></a>
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


    <!-- SweetAlert Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });

        // Prevent selecting past days in the date field
        document.addEventListener("DOMContentLoaded", function() {
            var dateInput = document.querySelector('input[type="date"]');
            var today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('min', today);
        });

        // Handle service type change based on selected service
        document.getElementById('service_id').addEventListener('change', function() {
            var serviceId = this.value;
            var serviceTypeSelect = document.getElementById('service_type_id');
            serviceTypeSelect.innerHTML = '<option value="">-- Select A Service Type --</option>';

            @foreach ($serviceTypes as $serviceType)
                if ({{ $serviceType->service_id }} == serviceId) {
                    var option = document.createElement('option');
                    option.value = '{{ $serviceType->id }}';
                    option.text = '{{ $serviceType->name }} ({{ number_format($serviceType->price, 0) }} FRW)';
                    serviceTypeSelect.appendChild(option);
                }
            @endforeach
        });
    </script>


@endsection

</html>
