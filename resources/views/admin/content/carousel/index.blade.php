@extends('admin.layouts.master')

@section('title', 'Manage Carousel')

@section('content')
    <!-- Page Header -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Manage Carousel</h3>
        <a href="{{ route('home.carousel.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Add New Carousel Item
        </a>
    </div>

    <!-- Carousel Table -->
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carousels as $carousel)
                            <tr>
                                <td>{{ $carousel->title }}</td>
                                <td>{{ $carousel->subtitle }}</td>
                                <td>{{ Str::limit($carousel->description, 50) }}</td> <!-- Truncate long descriptions -->
                                <td>
                                    <img src="{{ asset('storage/' . $carousel->image_path) }}" width="100"
                                        alt="{{ $carousel->title }}" class="img-thumbnail">
                                </td>
                                <td class="text-center">
                                    <!-- Action Buttons -->
                                    <div class="btn-group">
                                        <a href="{{ route('home.carousel.edit', $carousel->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('home.carousel.destroy', $carousel->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Custom Pagination -->
            <div class="d-flex justify-content-between mt-4">
                @if ($carousels->onFirstPage())
                    <span class="btn btn-secondary disabled">Previous</span>
                @else
                    <a href="{{ $carousels->previousPageUrl() }}" class="btn btn-primary">Previous</a>
                @endif

                @if ($carousels->hasMorePages())
                    <a href="{{ $carousels->nextPageUrl() }}" class="btn btn-primary">Next</a>
                @else
                    <span class="btn btn-secondary disabled">Next</span>
                @endif
            </div>
        </div>
    </div>
@endsection
