@extends('admin.layouts.master')

@section('title', 'Edit Pricing Plan')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3 class="font-weight-bold">Edit Pricing Plan</h3>
        <a href="{{ route('pricingplan.index') }}" class="btn btn-secondary">Back to Plans</a>
    </div>

    <div class="card shadow-sm mt-4" style="border-radius: 12px;">
        <div class="card-body p-5">
            <form action="{{ route('pricingplan.update', $pricingPlan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-4">
                    <label for="title" class="font-weight-bold">Plan Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ $pricingPlan->title }}" required placeholder="Enter Plan Title"
                        style="border-radius: 8px;">
                </div>

                <div class="form-group mb-4">
                    <label for="price" class="font-weight-bold">Price (Rwf)</label>
                    <input type="number" name="price" id="price" class="form-control"
                        value="{{ $pricingPlan->price }}" required placeholder="Enter Price" style="border-radius: 8px;">
                </div>

                <div class="form-group mb-4">
                    <label for="duration" class="font-weight-bold">Duration</label>
                    <select name="duration" id="duration" class="form-control" style="border-radius: 8px;">
                        <option value="Monthly" {{ $pricingPlan->duration == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="Yearly" {{ $pricingPlan->duration == 'Yearly' ? 'selected' : '' }}>Yearly</option>
                        <option value="Weekly" {{ $pricingPlan->duration == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="features" class="font-weight-bold">Select Features</label>
                    <div class="checkbox-group">
                        @foreach ($features as $feature)
                            <div class="form-check">
                                <input type="checkbox" name="features[]" id="feature_{{ $feature->id }}"
                                    value="{{ $feature->id }}"
                                    {{ in_array($feature->id, $pricingPlan->features->pluck('id')->toArray()) ? 'checked' : '' }}
                                    class="form-check-input">
                                <label class="form-check-label" for="feature_{{ $feature->id }}">
                                    {{ $feature->feature }} <!-- Update here to use the correct field -->
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 py-2" style="border-radius: 8px;">
                        <i class="fas fa-save"></i> Update Pricing Plan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
