@extends('admin.layouts.master')

@section('title', 'Manage Team Members')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Manage Team Members</h3>
        <a href="{{ route('team.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Add New Member
        </a>
    </div>

    <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-striped text-center align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Social Links</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teams as $team)
                        <tr>
                            <!-- Name and Position with icons -->
                            <td class="align-middle">
                                <h6 class="font-weight-bold">{{ $team->name }}</h6>
                            </td>
                            <td class="align-middle">
                                <span class="text-muted">{{ $team->position }}</span>
                            </td>

                            <!-- Social Links as buttons -->
                            <td class="align-middle">
                                <div class="d-flex justify-content-center">
                                    @if ($team->facebook_link)
                                        <a href="{{ $team->facebook_link }}" class="btn btn-sm btn-primary mx-1" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    @endif
                                    @if ($team->twitter_link)
                                        <a href="{{ $team->twitter_link }}" class="btn btn-sm btn-info mx-1" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    @endif
                                    @if ($team->linkedin_link)
                                        <a href="{{ $team->linkedin_link }}" class="btn btn-sm btn-secondary mx-1" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    @endif
                                    @if ($team->instagram_link)
                                        <a href="{{ $team->instagram_link }}" class="btn btn-sm btn-danger mx-1" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>

                            <!-- Display Image -->
                            <td class="align-middle">
                                @if ($team->image)
                                    <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}" width="50"
                                        height="50" style="border-radius: 50%; object-fit: cover;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <!-- Actions for edit and delete -->
                            <td class="align-middle">
                                <a href="{{ route('team.edit', $team->id) }}" class="btn btn-warning btn-sm mx-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('team.destroy', $team->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mx-1">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
