@extends('admin.layouts.master')

@section('title', 'Manage Facilities')

@section('content')

    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Services</h3>
                        <ul class="breadcrumb">

                        </ul>
                        <a href="{{ route('facilities.create') }}" class="btn btn-primary float-right">
                            <i class="feather-plus-circle"></i> Add New Facility
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0 datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Facility Name</th>
                                        <th>Service Types</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($facilities as $facility)
                                        <tr>
                                            <td>{{ $facility->name }}</td>
                                            <td>
                                                @foreach ($facility->serviceTypes as $type)
                                                    <span class="badge badge-info">{{ $type->name }}</span><br>
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('facilities.edit', $facility->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="feather-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('facilities.destroy', $facility->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="feather-trash-2"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
