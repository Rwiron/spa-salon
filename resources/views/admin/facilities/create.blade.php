@extends('admin.layouts.master')

@section('title', 'Create Facility')

@section('content')

    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Create New Facility</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('facilities.index') }}">Facilities</a>
                            </li>
                            <li class="breadcrumb-item active">Create Facility</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-body">
                        <form action="{{ route('facilities.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title service-info">
                                        Facility Information
                                        <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span>
                                    </h5>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label for="name">Facility Name <span class="login-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Enter Facility Name" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12">
                                    <div class="form-group local-forms">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter Description"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="service-submit">
                                        <button type="submit" class="btn btn-primary"> <i
                                                class="feather-plus-circle"></i> Create Facility</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
