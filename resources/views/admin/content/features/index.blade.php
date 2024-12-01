@extends('admin.layouts.master')

@section('title', 'Manage Pricing Features')

@section('content')
    <!-- Page Header -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Manage Pricing Features</h3>
        <a href="{{ route('pricingfeatures.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Add New Feature
        </a>
    </div>

    <!-- Features Table -->
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Feature Name</th>
                            <th>Plan Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($features as $feature)
                            <tr>
                                <td>{{ $feature->feature }}</td>
                                <td>{{ $feature->pricingPlan ? $feature->pricingPlan->title : 'No Plan Assigned' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('pricingfeatures.edit', $feature->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('pricingfeatures.destroy', $feature->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination with "Next" and "Previous" buttons -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
            @if ($features->onFirstPage())
                <button class="btn btn-outline-secondary" disabled>Previous</button>
            @else
                <a href="{{ $features->previousPageUrl() }}" class="btn btn-outline-primary">Previous</a>
            @endif
        </div>
        <div>
            @if ($features->hasMorePages())
                <a href="{{ $features->nextPageUrl() }}" class="btn btn-outline-primary">Next</a>
            @else
                <button class="btn btn-outline-secondary" disabled>Next</button>
            @endif
        </div>
    </div>
@endsection
