@extends('admin.layouts.master')

@section('title', 'Pricing Plans')

@section('content')
    <div class="page-header">
        <h3>Manage Pricing Plans</h3>
        <a href="{{ route('pricingplan.create') }}" class="btn btn-primary">Add New Pricing Plan</a>
    </div>

    <div class="row mt-4">
        @foreach ($pricingPlans as $plan)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">{{ $plan->title }}</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title pricing-card-title">{{ number_format($plan->price, 2) }} Rwf</h5>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li><strong>Duration:</strong> {{ $plan->duration }}</li>
                            {{-- Add other features related to the pricing plan --}}
                        </ul>
                        <a href="{{ route('pricingplan.edit', $plan->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('pricingplan.destroy', $plan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>

                    {{-- Section to display selected features --}}
                    @if ($plan->sunday_hours == 'Opened')
                        <div class="card-footer">
                            <strong>Sunday Hours: </strong> Opened
                        </div>
                    @elseif ($plan->sunday_hours == 'Closed')
                        <div class="card-footer">
                            <strong>Sunday Hours: </strong> Closed
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
