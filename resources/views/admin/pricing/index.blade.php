@extends('admin.layouts.master')

@section('title', 'Manage Service Pricing')

@section('content')
    <div class="page-header">
        <h3>Manage Service Pricing</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPricingModal">Add New Pricing</button>
    </div>

    <!-- Pricing Table -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Price (FRW)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pricings as $pricing)
                    <tr>
                        <td>{{ $pricing->serviceType->service->name }}</td> <!-- Fetch service name -->
                        <td>{{ $pricing->price }} FRW</td>
                        <td>
                            <a href="{{ route('pricing.edit', $pricing->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pricing.destroy', $pricing->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Pricing Modal -->
    <div class="modal fade" id="addPricingModal" tabindex="-1" aria-labelledby="addPricingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPricingModalLabel">Add New Pricing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pricing.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="service_id">Select Service</label>
                            <select name="service_id" id="service_id" class="form-control" required>
                                <option value="">-- Select Service --</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Price (FRW)</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Pricing</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
