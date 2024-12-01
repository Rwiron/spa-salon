@extends('admin.layouts.master')

@section('title', 'Add Students')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Add Students</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Student</a></li>
                        <li class="breadcrumb-item active">Add Students</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card comman-shadow">
                <div class="card-body">
                    <form>
                        <!-- Add your form fields here -->
                        <div class="row">
                            <!-- Form elements go here -->
                        </div>
                        <div class="student-submit">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
