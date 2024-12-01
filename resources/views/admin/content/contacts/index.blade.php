@extends('admin.layouts.master')

@section('title', 'Manage Contact Messages')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3>Manage Contact Messages</h3>
    </div>

    <!-- Select All Checkbox and Delete Button -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <input type="checkbox" id="select-all" class="mr-2">
            <label for="select-all">Select All</label>
        </div>
        <button class="btn btn-danger btn-sm" id="delete-selected" disabled>
            <i class="fas fa-trash-alt"></i> Delete Selected
        </button>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-hover table-striped table-bordered" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <thead class="thead-dark">
                <tr>
                    <th>
                        <input type="checkbox" id="select-all-top">
                    </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>
                            <input type="checkbox" class="select-row" value="{{ $contact->id }}">
                        </td>
                        <td>
                            <i class="fas fa-user text-primary mr-2"></i>{{ $contact->name }}
                        </td>
                        <td>
                            <i class="fas fa-envelope text-success mr-2"></i>{{ $contact->email }}
                        </td>
                        <td>
                            <i class="fas fa-tag text-warning mr-2"></i>{{ $contact->subject }}
                        </td>
                        <td>
                            {{ Str::limit($contact->message, 50) }}
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
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
                        fetch('{{ route('admin.contacts.bulkDelete') }}', {
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
                                    Swal.fire('Deleted!', data.message, 'success')
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    Swal.fire('Error!', data.message, 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Error!', 'There was an issue deleting the contacts.',
                                    'error');
                                console.error('Error:', error);
                            });
                    }
                });
            }
        });
    </script>
@endsection
