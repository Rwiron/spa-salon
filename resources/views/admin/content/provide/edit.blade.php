@extends('admin.layouts.master')

@section('title', 'Edit Provide')

@section('content')
    <div class="page-header">
        <h3>Edit Provide</h3>
        <a href="{{ route('provide.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <form action="{{ route('provide.update', $provide->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $provide->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $provide->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Provide Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <small class="form-text text-muted">Leave blank if you don't want to update the image.</small>
            @if ($provide->image_path)
                <img src="{{ asset('storage/' . $provide->image_path) }}" alt="{{ $provide->title }}" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Provide</button>
    </form>
@endsection
