@extends('admin.layouts.master')

@section('title', 'Create Service Type')

@section('content')

    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Create New Service Type</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('service_types.index') }}">Service Types</a>
                            </li>
                            <li class="breadcrumb-item active">Add Service Type</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-body">
                        <form action="{{ route('service_types.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title service-info">
                                        Service Type Information
                                        <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span>
                                    </h5>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Select Service <span class="login-danger">*</span></label>
                                        <select name="service_id" id="service_id" class="form-control select" required>
                                            <option value="">-- Select Service --</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Service Type Name <span class="login-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Enter Service Type Name" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Price (FRW) <span class="login-danger">*</span></label>
                                        <input type="number" name="price" id="price" class="form-control"
                                            placeholder="Enter Price" step="0.01" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="service-submit">
                                        <button type="submit" class="btn btn-primary"> <i class="feather-plus-circle"></i>
                                            Create Service Type
                                        </button>
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
