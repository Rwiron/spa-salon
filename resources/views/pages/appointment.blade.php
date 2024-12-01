@extends('layout.master')

@section('appointment', 'Home - Alcobra Dubai Kigali_Salon and Spa')

@section('content')

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid bg-jumbotron" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h3 class="text-white display-3 mb-4">Appointment</h3>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="">Home</a></p>
                <i class="far fa-circle px-3"></i>
                <p class="m-0">Appointment</p>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Appointment Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row mx-0 justify-content-center text-center">
                <div class="col-lg-6">
                    <h6 class="d-inline-block bg-light text-primary text-uppercase py-1 px-2">Appointment</h6>
                    <h1 class="mb-5">Make An Appointment</h1>
                </div>
            </div>
            <div class="row justify-content-center bg-appointment mx-0">
                <div class="col-lg-6 py-5">
                    <div class="p-5 my-5" style="background: rgba(33, 30, 28, 0.7);">
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

                        <style>
                            ::placeholder {
                                color: white;
                                opacity: 0.8;
                            }
                        </style>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->

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


    <!-- Handle service type change dynamically -->
    <script>
        // Prevent selecting past days in the date field
        document.addEventListener("DOMContentLoaded", function() {
            var dateInput = document.querySelector('input[type="date"]');
            var today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('min', today);
        });

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
