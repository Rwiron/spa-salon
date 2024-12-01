@extends('admin.layouts.master')

@section('title', 'Edit Appointment')

@section('content')
    <div class="page-header">
        <h3>Edit Appointment</h3>
    </div>

    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Client Name -->
        <div class="form-group">
            <label for="name">Client Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $appointment->name }}" required>
        </div>

        <!-- Client Email -->
        <div class="form-group">
            <label for="email">Client Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $appointment->email }}"
                required>
        </div>

        <!-- Client Phone -->
        <div class="form-group">
            <label for="phone">Client Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $appointment->phone }}"
                required>
        </div>

        <!-- Service Selection -->
        <div class="form-group">
            <label for="service_id">Select Service</label>
            <select name="service_id" id="service_id" class="form-control" required>
                <option value="">-- Select Service --</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ $service->id == $appointment->service_id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Service Type Selection -->
        <div class="form-group">
            <label for="servicetype_id">Select Service Type</label>
            <select name="servicetype_id" id="servicetype_id" class="form-control" required>
                <option value="">-- Select Service Type --</option>
                @foreach ($serviceTypes as $serviceType)
                    <option value="{{ $serviceType->id }}"
                        {{ $serviceType->id == $appointment->servicetype_id ? 'selected' : '' }}>
                        {{ $serviceType->name }} ({{ number_format($serviceType->price, 0) }} FRW)
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Appointment Date -->
        <div class="form-group">
            <label for="date">Appointment Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $appointment->date }}"
                required>
        </div>

        <!-- Appointment Time -->
        <div class="form-group">
            <label for="time">Appointment Time</label>
            <input type="time" name="time" id="time" class="form-control" value="{{ $appointment->time }}"
                required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Appointment</button>
    </form>

    <!-- Service Type Dropdown based on Selected Service -->
    <script>
        document.getElementById('service_id').addEventListener('change', function() {
            const serviceId = this.value;
            const serviceTypeSelect = document.getElementById('servicetype_id');

            // Clear previous options
            serviceTypeSelect.innerHTML = '<option value="">-- Select Service Type --</option>';

            // Fetch service types for the selected service
            fetch(`/api/service-types/${serviceId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(type => {
                        const option = document.createElement('option');
                        option.value = type.id;
                        option.textContent = `${type.name} - ${type.price} FRW`;
                        serviceTypeSelect.appendChild(option);
                    });
                });
        });
    </script>
@endsection
