@extends('admin.layouts.master')

@section('title', 'Manage Provide')

@section('content')
    <div class="page-header">
        <h3>Manage Provide</h3>
        <a href="{{ route('provide.create') }}" class="btn btn-primary">Add New Provide</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($provides as $provide)
                    <tr>
                        <td>{{ $provide->title }}</td>
                        <td>{{ Str::limit($provide->description, 100) }}</td>
                        <td><img src="{{ asset('storage/' . $provide->image_path) }}" width="100"></td>
                        <td>
                            <a href="{{ route('provide.edit', $provide->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('provide.destroy', $provide->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
