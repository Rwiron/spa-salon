@extends('admin.layouts.master')

@section('title', 'Pricing Plan Details')

@section('content')
    <div class="page-header">
        <h3>{{ $pricingPlan->title }} Plan Details</h3>
        <a href="{{ route('pricingplan.index') }}" class="btn btn-secondary">Back to Plans</a>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h4>Price: ${{ $pricingPlan->price }} / {{ $pricingPlan->duration }}</h4>
            <h5>Features:</h5>
            <ul>
                @foreach ($pricingPlan->features as $feature)
                    <li>{{ $feature->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
