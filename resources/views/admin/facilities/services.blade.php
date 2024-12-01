@extends('admin.layouts.master')

@section('title', 'Services')

@section('content')

    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Services & Service Types</h3>
                        <ul class="breadcrumb">
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($services as $service)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card service-card h-100 shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title">{{ $service->name }}</h4>
                            <ul class="list-unstyled mt-3 mb-4">
                                @foreach ($service->serviceTypes as $type)
                                    <li class="d-flex justify-content-between">
                                        <span>{{ $type->name }}</span>
                                        <span class="text-muted">{{ round($type->price / 1000) }}k</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Simple Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $services->links('pagination::default') }}
        </div>
    </div>

@endsection

@section('styles')
    <style>
        .service-card {
            transition: transform 0.2s ease-in-out;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 1.2rem;
            color: #007bff;
        }

        .list-unstyled li {
            font-size: 1rem;
            padding: 10px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        .list-unstyled li:last-child {
            border-bottom: none;
        }

        /* Simple Pagination Styling */
        .pagination {
            display: flex;
            justify-content: left;

        }

        .pagination .page-item .page-link {
            color: #007bff;
            padding: 8px 15px;
            margin: 0 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .pagination .page-item .page-link:hover {
            background-color: #f1f1f1;
        }

        .pagination .page-item.disabled .page-link {
            color: #ddd;
        }
    </style>
@endsection
