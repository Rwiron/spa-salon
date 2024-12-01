@extends('admin.layouts.master')

@section('title', 'Manage Appointments')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header d-flex justify-content-between align-items-center">
                        <h3 class="page-title">Appointments</h3>
                        <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                            <i class="feather-plus-circle"></i> Add New Appointment
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pending Appointments -->
        <div class="col-xl-4 col-sm-4 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h5>Total pending Appointment </h5>
                            <h3>{{ $pendingAppointmentsCount }}</h3>
                        </div>
                        <div class="db-icon">
                            <img src="{{ asset('assets/img/icons/dash-icon-02.svg') }}" alt="Dashboard Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Form -->
        <form action="{{ route('appointments.index') }}" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Client Name</label>
                        <input type="text" name="name" class="form-control" value="{{ request('name') }}"
                            placeholder="Enter Client Name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email">Client Email</label>
                        <input type="email" name="email" class="form-control" value="{{ request('email') }}"
                            placeholder="Enter Client Email">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="time" name="time" class="form-control" value="{{ request('time') }}">
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-center">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="feather-search"></i> Search
                    </button>
                </div>
            </div>
        </form>

        <!-- Appointments Table -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0 datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Client Email</th>
                                        <th>Phone</th> <!-- New Phone Column -->
                                        <th>Service</th>
                                        <th>Service Type</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->name }}</td>
                                            <td>{{ $appointment->email }}</td>
                                            <td>{{ $appointment->phone }}</td> <!-- Display phone number -->
                                            <td>{{ $appointment->service->name }}</td>
                                            <td>{{ $appointment->serviceType->name }}</td>
                                            <td>{{ number_format($appointment->serviceType->price, 0) }} FRW</td>
                                            <td>{{ $appointment->date }}</td>
                                            <td>{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</td>
                                            <td class="text-center">
                                                <!-- WhatsApp Action -->
                                                <a href="https://wa.me/250{{ $appointment->phone }}?text={{ urlencode(
                                                    "
                                                                                                    📅 *Appointment Confirmation* \n\n
                                                                                                    👤 *Client Details:* \n
                                                                                                    - *Name:* {$appointment->name} \n
                                                                                                    - *Phone:* {$appointment->phone} \n
                                                                                                    - *Email:* {$appointment->email} \n\n
                                                                                                    🛎 *Service Information:* \n
                                                                                                    - *Service:* {$appointment->service->name} \n
                                                                                                    - *Service Type:* {$appointment->serviceType->name} \n
                                                                                                    - *Price:* " .
                                                        number_format($appointment->serviceType->price, 0) .
                                                        " FRW \n\n
                                                                                                    📆 *Appointment Date & Time:* \n
                                                                                                    - *Date:* " .
                                                        date('d-m-Y', strtotime($appointment->date)) .
                                                        " \n
                                                                                                    - *Time:* " .
                                                        date('H:i', strtotime($appointment->time)) .
                                                        " \n\n
                                                                                                    Thank you for choosing Alcobra Dubai Kigali Salon & Spa. We look forward to seeing you!",
                                                ) }}"
                                                    target="_blank" class="btn btn-sm btn-success">
                                                    <i class="fab fa-whatsapp"></i> Send WhatsApp Message
                                                </a>

                                                <form action="{{ route('appointments.accept', $appointment->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="feather-check"></i> Save Accepted Apppointment
                                                    </button>
                                                </form>
                                                <form action="{{ route('appointments.decline', $appointment->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="feather-x"></i> Decline
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-3 d-flex justify-content-between">
                            @if ($appointments->onFirstPage())
                                <button class="btn btn-secondary" disabled>Previous</button>
                            @else
                                <a href="{{ $appointments->previousPageUrl() }}" class="btn btn-primary">Previous</a>
                            @endif

                            @if ($appointments->hasMorePages())
                                <a href="{{ $appointments->nextPageUrl() }}" class="btn btn-primary">Next</a>
                            @else
                                <button class="btn btn-secondary" disabled>Next</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
