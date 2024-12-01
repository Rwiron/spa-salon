@extends('admin.layouts.master')

@section('title', 'Add New Feature')

@section('content')
    <!-- Page Header -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Add New Feature</h3>
        <a href="{{ route('pricingfeatures.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Features
        </a>
    </div>

    <!-- Feature Form -->
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <form action="{{ route('pricingfeatures.store') }}" method="POST">
                @csrf

                <!-- Feature Name -->
                <div class="form-group">
                    <label for="feature" class="font-weight-bold">Feature Name</label>
                    <input type="text" name="feature" id="feature" class="form-control"
                        placeholder="Enter feature name" required>
                </div>

                <!-- Pricing Plan Selection -->
                <div class="form-group">
                    <label for="pricing_plan_id" class="font-weight-bold">Select Pricing Plan</label>
                    <select name="pricing_plan_id" id="pricing_plan_id" class="custom-select"
                        style="padding: 12px; border-radius: 10px; background-color: #f9f9f9; border: 1px solid #ccc;"
                        required>
                        <option value="" disabled selected>-- Select Pricing Plan --</option>
                        @foreach ($pricingPlans as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->title }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Button Group for Save and Back -->
                <div class="d-flex justify-content-between mt-4">
                    <!-- Save Button -->
                    <button type="submit" class="btn btn-primary" style="border-radius: 10px;">
                        <i class="fas fa-save"></i> Save Feature
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
