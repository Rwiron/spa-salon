@extends('admin.layouts.master')

@section('title', 'Add New User')

@section('content')
    <div class="page-header">
        <h3>Add New User</h3>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
    </div>

    <div class="container mt-4">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="role_id">Role</label>
                <select name="role_id" id="role_id" class="form-control" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>
@endsection
