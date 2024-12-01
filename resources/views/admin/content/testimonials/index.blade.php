@extends('admin.layouts.master')

@section('title', 'Manage Testimonials')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Manage Testimonials</h3>
        <a href="{{ route('testimonials.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Add New Testimonial
        </a>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-hover table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Client Name</th>
                    <th>Profession</th>
                    <th>Testimonial</th>
                    <th>Image</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($testimonials as $testimonial)
                    <tr>
                        <!-- Client Name -->
                        <td class="align-middle">
                            <h5 class="mb-0 font-weight-bold">{{ $testimonial->client_name }}</h5>
                        </td>

                        <!-- Profession -->
                        <td class="align-middle">
                            <span class="badge badge-info">{{ $testimonial->profession }}</span>
                        </td>

                        <!-- Testimonial (truncate long text) -->
                        <td class="align-middle">
                            <p class="text-muted">{{ Str::limit($testimonial->testimonial, 50, '...') }}</p>
                        </td>

                        <!-- Image -->
                        <td class="align-middle text-center">
                            @if ($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->client_name }}"
                                    width="50" height="50" class="rounded-circle img-thumbnail">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="align-middle text-center">
                            <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-warning mx-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger mx-1">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
