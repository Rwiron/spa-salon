@extends('admin.layouts.master')

@section('title', 'Add Pricing')

@section('content')
    <div class="page-header">
        <h3>Add Pricing for {{ $serviceType->name }}</h3>
    </div>

    <form action="{{ route('pricing.store', $serviceType->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="price">Price (FRW)</label>
            <input type="number" name="price" id="price" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Pricing</button>
    </form>
@endsection
