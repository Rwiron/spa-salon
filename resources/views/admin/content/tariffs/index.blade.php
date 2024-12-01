@extends('admin.layouts.master')

@section('title', 'Manage Tariffs')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Manage Tariffs</h3>
        <a href="{{ route('tariffs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Add New Tariff
        </a>
    </div>

    @if (session('success'))
        @include('messages._message')
    @endif

    <div class="table-responsive mt-4">
        <table class="table table-hover table-striped table-bordered" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Available At</th>
                    <th>Expires At</th>
                    <th>File</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tariffs as $tariff)
                    <tr>
                        <td>{{ $tariff->name }}</td>
                        <td>{{ Str::limit($tariff->description, 50) }}</td>
                        <td>{{ $tariff->available_at ? \Carbon\Carbon::parse($tariff->available_at)->format('Y-m-d') : 'N/A' }}
                        </td>
                        <td>{{ $tariff->expires_at ? \Carbon\Carbon::parse($tariff->expires_at)->format('Y-m-d') : 'N/A' }}
                        </td>
                        <td>
                            <a href="{{ asset('storage/' . $tariff->file_path) }}" target="_blank"
                                class="btn btn-info btn-sm">
                                View File
                            </a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('tariffs.destroy', $tariff->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- SweetAlert Trigger -->
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
