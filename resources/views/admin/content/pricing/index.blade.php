@php
    function formatPrice($number)
    {
        if ($number >= 1000 && $number < 1000000) {
            return number_format($number / 1000, 0) . 'K';
        } elseif ($number >= 1000000 && $number < 1000000000) {
            return number_format($number / 1000000, 0) . 'M';
        } elseif ($number >= 1000000000) {
            return number_format($number / 1000000000, 0) . 'B';
        }
        return number_format($number, 2); // Default format for smaller numbers
    }
@endphp

@extends('admin.layouts.master')

@section('title', 'Manage Pricing Plans')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Manage Pricing Plans</h3>
        <a href="{{ route('pricingplan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Add New Plan
        </a>
    </div>

    <div class="row justify-content-center mt-4">
        @foreach ($pricingPlans as $plan)
            <div class="col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
                <div class="card shadow-sm border-0" style="border-radius: 12px; width: 100%; max-width: 350px;">
                    <div class="card-body text-center py-5">
                        <!-- Title -->
                        <h4 class="card-title font-weight-bold">{{ $plan->title }}</h4>

                        <!-- Price -->
                        <h2 class="card-price my-3">
                            <strong class="text-primary">{{ formatPrice($plan->price) }} Rwf</strong>
                            <small class="text-muted">/ {{ $plan->duration }}</small>
                        </h2>

                        <!-- Features -->
                        <ul class="list-unstyled mt-3 mb-4 text-left" style="line-height: 2;">
                            @foreach ($plan->features as $feature)
                                <li class="d-flex align-items-center">
                                    <i class="fa fa-check text-success mr-2"></i>{{ $feature->feature }}
                                </li>
                            @endforeach
                        </ul>

                        <!-- Actions -->
                        <a href="{{ route('pricingplan.edit', $plan->id) }}"
                            class="btn btn-outline-warning btn-block">Edit</a>
                        <form action="{{ route('pricingplan.destroy', $plan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-block mt-2">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
