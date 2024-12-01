@extends('admin.layouts.master')

@section('title', 'Manage Gallery')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Manage Gallery</h3>
        <a href="{{ route('gallery.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Add New Image
        </a>
    </div>

    <!-- Bulk Delete Section -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <input type="checkbox" id="select-all" class="mr-2">
            <label for="select-all">Select All</label>
        </div>
        <button class="btn btn-danger btn-sm" id="delete-selected" disabled>
            <i class="fas fa-trash-alt"></i> Delete Selected
        </button>
    </div>

    <!-- Gallery Table -->
    <div class="table-responsive mt-4">
        <table class="table table-hover table-striped table-bordered" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <thead class="thead-light">
                <tr class="text-center">
                    <th>
                        <input type="checkbox" id="select-all-top">
                    </th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($galleries as $gallery)
                    <tr class="text-center align-middle">
                        <td>
                            <input type="checkbox" class="select-row" value="{{ $gallery->id }}">
                        </td>
                        <td>{{ $gallery->title }}</td>
                        <td>{{ Str::limit($gallery->description, 50) }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}"
                                class="rounded shadow-sm" width="100" height="100">
                        </td>
                        <td class="d-flex justify-content-center">
                            <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger mx-2">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Section -->
    <div class="d-flex justify-content-between mt-3">
        @if ($galleries->onFirstPage())
            <button class="btn btn-secondary mr-2" disabled>Previous</button>
        @else
            <a href="{{ $galleries->previousPageUrl() }}" class="btn btn-primary mr-2">Previous</a>
        @endif

        @if ($galleries->hasMorePages())
            <a href="{{ $galleries->nextPageUrl() }}" class="btn btn-primary">Next</a>
        @else
            <button class="btn btn-secondary" disabled>Next</button>
        @endif
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

    <!-- JavaScript for Select All and Bulk Delete -->
    <script>
        // Select All functionality
        document.getElementById('select-all').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.select-row');
            const isChecked = this.checked;
            checkboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
            toggleDeleteButton();
        });

        // Enable/Disable "Delete Selected" button based on selections
        document.querySelectorAll('.select-row').forEach(checkbox => {
            checkbox.addEventListener('change', toggleDeleteButton);
        });

        function toggleDeleteButton() {
            const checkboxes = document.querySelectorAll('.select-row:checked');
            document.getElementById('delete-selected').disabled = checkboxes.length === 0;
        }

        // Bulk Delete functionality
        document.getElementById('delete-selected').addEventListener('click', function() {
            const selectedIds = Array.from(document.querySelectorAll('.select-row:checked'))
                .map(checkbox => checkbox.value);

            if (selectedIds.length > 0) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete ${selectedIds.length} selected record(s)!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete them!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the selected IDs to the server for deletion
                        fetch('{{ route('gallery.bulkDelete') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    ids: selectedIds
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Deleted!', data.message, 'success');
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            }
        });
    </script>
@endsection
