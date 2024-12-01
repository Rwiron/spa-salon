@extends('admin.layouts.master')

@section('title', 'Edit Pricing Feature')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3 class="font-weight-bold">Edit Pricing Feature</h3>
        <a href="{{ route('pricingfeatures.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Features List
        </a>
    </div>

    <div class="card shadow-sm mt-4" style="border-radius: 12px;">
        <div class="card-body p-5">
            <form action="{{ route('pricingfeatures.update', $feature->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Feature Name -->
                <div class="form-group mb-4">
                    <label for="feature" class="font-weight-bold">Feature Name</label>
                    <input type="text" name="feature" id="feature" class="form-control" value="{{ $feature->feature }}"
                        placeholder="Enter feature name" required style="border-radius: 8px;">
                </div>

                <!-- Select Pricing Plan -->
                <div class="form-group mb-4">
                    <label for="pricing_plan_id" class="font-weight-bold">Select Pricing Plan</label>
                    <select name="pricing_plan_id" id="pricing_plan_id" class="form-control" style="border-radius: 8px;"
                        required>
                        <option value="">-- Select Pricing Plan --</option>
                        @foreach ($pricingPlans as $plan)
                            <option value="{{ $plan->id }}"
                                {{ $feature->pricing_plan_id == $plan->id ? 'selected' : '' }}>
                                {{ $plan->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 py-2" style="border-radius: 8px;">
                        <i class="fas fa-save"></i> Update Feature
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
