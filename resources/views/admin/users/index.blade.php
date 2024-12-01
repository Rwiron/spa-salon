@extends('admin.layouts.master')

@section('title', 'Manage Users')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Manage Users</h3>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Add New User
        </a>
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td> <!-- Show user role -->
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
