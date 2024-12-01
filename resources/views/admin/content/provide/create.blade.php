@extends('admin.layouts.master')

@section('title', 'Create Provide')

@section('content')
    <div class="page-header">
        <h3>Create New Provide</h3>
    </div>

    <form action="{{ route('provide.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Provide</button>
    </form>
@endsection
