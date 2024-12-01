@extends('admin.layouts.master')

@section('title', 'Create Pricing Plan')

@section('content')
    <div class="page-header">
        <h3>Create New Pricing Plan</h3>
    </div>

    <form action="{{ route('pricingplan.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="duration">Duration</label>
            <select name="duration" id="duration" class="form-control" required>
                <option value="Monthly">Monthly</option>
                <option value="Yearly">Yearly</option>
                <option value="Weekly">Weekly</option>
            </select>
        </div>

        <div class="form-group">
            <label for="features">Select Features</label>
            <select name="features[]" id="features" class="form-control" multiple>
                @foreach ($features as $feature)
                    <option value="{{ $feature->id }}">{{ $feature->feature }}</option>
                    <!-- Assuming the feature field is 'feature' -->
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Pricing Plan</button>
    </form>
@endsection
