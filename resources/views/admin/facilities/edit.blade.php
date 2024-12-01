@extends('admin.layouts.master')

@section('title', 'Edit Facility')

@section('content')
    <div class="page-header">
        <h3>Edit Facility: {{ $facility->name }}</h3>
    </div>

    <form action="{{ route('facilities.update', $facility->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Facility Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $facility->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $facility->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Facility</button>
    </form>
@endsection
