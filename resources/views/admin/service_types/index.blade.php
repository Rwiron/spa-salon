@extends('admin.layouts.master')

@section('title', 'Manage Service Types')

@section('content')
    <div class="page-header">
        <h3>Manage Service Types</h3>
        <a href="{{ route('service_types.create') }}" class="btn btn-primary"> <i class="feather-plus-circle"></i> Add New
            Service Type</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Associated Service</th>
                    <th>Service Type Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($serviceTypes as $serviceType)
                    <tr>

                        <td>{{ $serviceType->service->name }}</td> <!-- Display the associated service -->
                        <td>{{ $serviceType->name }}</td>
                        <td>
                            <a href="{{ route('service_types.edit', $serviceType->id) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('service_types.destroy', $serviceType->id) }}" method="POST"
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
