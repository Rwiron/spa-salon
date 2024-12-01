@extends('admin.layouts.master')

@section('title', 'Edit Open Hours')

@section('content')
    <div class="page-header">
        <h3>Edit Open Hours</h3>
        <a href="{{ route('openhours.index') }}" class="btn btn-secondary">Back to Open Hours</a>
    </div>

    <div class="container mt-4">
        <form action="{{ route('openhours.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $openHours->title }}"
                    required>
            </div>

            <div class="form-group">
                <label for="subtitle">Subtitle</label>
                <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ $openHours->subtitle }}"
                    required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ $openHours->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="weekday_start">Weekday Start Time</label>
                <input type="time" name="weekday_start" id="weekday_start" class="form-control"
                    value="{{ old('weekday_start', $openHours->weekday_start ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="weekday_end">Weekday End Time</label>
                <input type="time" name="weekday_end" id="weekday_end" class="form-control"
                    value="{{ old('weekday_end', $openHours->weekday_end ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="saturday_start">Saturday Start Time</label>
                <input type="time" name="saturday_start" id="saturday_start" class="form-control"
                    value="{{ old('saturday_start', $openHours->saturday_start ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="saturday_end">Saturday End Time</label>
                <input type="time" name="saturday_end" id="saturday_end" class="form-control"
                    value="{{ old('saturday_end', $openHours->saturday_end ?? '') }}" required>
            </div>
            <!-- Sunday Hours -->
            <div class="form-group">
                <label for="sunday_hours">Sunday Hours</label>
                <select name="sunday_hours" id="sunday_hours" class="form-control" required>
                    <option value="Closed" {{ $openHours->sunday_hours == 'Closed' ? 'selected' : '' }}>Closed</option>
                    <option value="Opened" {{ $openHours->sunday_hours == 'Opened' ? 'selected' : '' }}>Opened</option>
                </select>
            </div>

            <!-- Image Upload -->
            <div class="form-group">
                <label for="image">Open Hours Image (optional)</label>
                <input type="file" name="image" id="image" class="form-control">
                <small class="form-text text-muted">Leave blank if you don't want to update the image.</small>
                <br>
                @if ($openHours->image_path)
                    <img src="{{ asset('storage/' . $openHours->image_path) }}" alt="Open Hours Image" width="200"
                        class="img-fluid mt-3">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Open Hours</button>
        </form>
    </div>
@endsection
