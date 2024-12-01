@extends('admin.layouts.master')

@section('title', 'Accepted Appointments')

@section('content')
    <div class="page-header">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Accepted Appointments</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Accepted Appointments</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Total Accepted Appointments</h6>
                                    <h3>{{ $totalAcceptedAppointments }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('assets/img/icons/teacher-icon-03.svg') }}"
                                        alt="Total Appointments Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Form -->
            <div class="card comman-shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('appointments.accepted') }}" method="GET">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="name">Client Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ request('name') }}"
                                        placeholder="Enter Client Name">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="email">Client Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ request('email') }}"
                                        placeholder="Enter Client Email">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="time">Time</label>
                                    <input type="time" name="time" class="form-control" value="{{ request('time') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary mt-3 w-100">
                                    <i class="feather-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Accepted Appointments Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0 datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Client Name</th>
                                            <th>Client Phone</th> <!-- Add this line to display phone number -->
                                            <th>Client Email</th>
                                            <th>Service</th>
                                            <th>Service Type</th>
                                            <th>Price</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($acceptedAppointments as $appointment)
                                            <tr>
                                                <td>{{ $appointment->name }}</td>
                                                <td>{{ $appointment->phone }}</td> <!-- Display phone number here -->
                                                <td>{{ $appointment->email }}</td>
                                                <td>{{ $appointment->service->name }}</td>
                                                <td>{{ $appointment->serviceType->name }}</td>
                                                <td>{{ number_format($appointment->serviceType->price, 0) }} FRW</td>
                                                <td>{{ $appointment->date }}</td>
                                                <td>{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                {{ $acceptedAppointments->links() }} <!-- Pagination links -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
