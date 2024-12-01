@extends('admin.layouts.master')

@section('title', 'Customer Dashboard')

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title">Welcome, {{ Auth::user()->name }}!</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Customer Dashboard</li>
            </ul>
        </div>

        <!-- Welcome Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="card comman-shadow">
                    <div class="card-body text-center">
                        <h4 class="card-title">Hello {{ Auth::user()->name }}!</h4>
                        <p>We are delighted to have you as our customer. Feel free to browse through our services, book
                            appointments, and explore everything we have to offer.</p>
                        <a href="{{ route('appointments.index') }}" class="btn btn-primary">Make Appointments</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar Section -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card comman-shadow">
                    <div class="card-body">
                        <h4 class="card-title">Your Beauty Schedule</h4>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>

            <!-- Iframe to display website -->
            <div class="col-md-6">
                <div class="card comman-shadow">
                    <div class="card-body">
                        <h4 class="card-title">Browse Our Website</h4>
                        <iframe src="{{ url('/') }}" frameborder="0" width="100%" height="443px"
                            id="website-frame"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fun Fact Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card comman-shadow">
                    <div class="card-body text-center">
                        <h4 class="card-title">Beauty Inspiration</h4>
                        <p class="quote">{{ getRandomBeautyQuote() }}</p> <!-- Generates a random quote -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include FullCalendar JS and CSS Libraries -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>

    <!-- Initialize FullCalendar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 450,
                events: [
                    // Add events dynamically here if needed
                ]
            });
            calendar.render();
        });
    </script>

    <!-- Page CSS -->
    <style>
        .page-header {
            margin-bottom: 30px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Calendar Styling */
        #calendar {
            max-width: 100%;
            margin: 0 auto;
        }

        /* Fun Fact Styling */
        .quote {
            font-size: 1.2rem;
            font-style: italic;
            color: #6c757d;
        }

        /* Iframe Styling */
        #website-frame {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>

    @php
        // Function to generate random beauty quotes
        function getRandomBeautyQuote()
        {
            $quotes = [
                '“Beauty begins the moment you decide to be yourself.” – Coco Chanel',
                '“Invest in your skin. It’s going to represent you for a very long time.” – Linden Tyler',
                '“Beauty is not in the face; beauty is a light in the heart.” – Kahlil Gibran',
                '“Self-care is not a luxury, it’s a necessity.”',
                '“To me, beauty is about being comfortable in your own skin. It’s about knowing and accepting who you are.” – Ellen DeGeneres',
            ];
            return $quotes[array_rand($quotes)];
        }
    @endphp
@endsection
