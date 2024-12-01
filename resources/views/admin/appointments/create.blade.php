@extends('admin.layouts.master')

@section('title', 'Create Appointment')

@section('content')

    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Create New Appointment</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('appointments.index') }}">Appointments</a></li>
                            <li class="breadcrumb-item active">Create Appointment</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('appointments.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Client Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Client Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter client name" required>
                                </div>

                                <!-- Client Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Client Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Enter client email" required>
                                </div>

                                <!-- Client Phone -->
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Client Phone <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        placeholder="Enter client phone number" required>
                                </div>

                                <!-- Service -->
                                <div class="col-md-6 mb-3">
                                    <label for="service_id" class="form-label">Select Service <span
                                            class="text-danger">*</span></label>
                                    <select name="service_id" id="service_id" class="form-select" required>
                                        <option value="">-- Select Service --</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Service Type -->
                                <div class="col-md-6 mb-3">
                                    <label for="service_type_id" class="form-label">Select Service Type <span
                                            class="text-danger">*</span></label>
                                    <select name="service_type_id" id="service_type_id" class="form-select" required>
                                        <option value="">-- Select Service Type --</option>
                                        @foreach ($serviceTypes as $serviceType)
                                            <option value="{{ $serviceType->id }}"
                                                data-service="{{ $serviceType->service_id }}">
                                                {{ $serviceType->name }} ({{ number_format($serviceType->price, 0) }} FRW)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Appointment Date -->
                                <div class="col-md-6 mb-3">
                                    <label for="date" class="form-label">Appointment Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="date" id="date" class="form-control" required>
                                </div>

                                <!-- Appointment Time -->
                                <div class="col-md-6 mb-3">
                                    <label for="time" class="form-label">Appointment Time <span
                                            class="text-danger">*</span></label>
                                    <input type="time" name="time" id="time" class="form-control" required>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary px-5">Create Appointment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('service_id').addEventListener('change', function() {
            var serviceId = this.value;
            var serviceTypeSelect = document.getElementById('service_type_id');

            // Reset service type options
            serviceTypeSelect.innerHTML = '<option value="">-- Select Service Type --</option>';

            // Loop through the service types and only show the ones matching the selected service
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
