@extends('admin.layouts.master')

@section('title', 'My Profile')

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Profile Details -->
        <div class="row">
            <!-- First Card with Image, Name, Email, Location -->
            <div class="col-lg-6">
                <div class="card custom-height-card"> <!-- Added custom class 'custom-height-card' -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto profile-image">
                                <img class="rounded-circle" alt="User Image"
                                    src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('assets/img/default-avatar.png') }}"
                                    width="100" />
                            </div>
                            <div class="col ms-md-n2 profile-user-info">
                                <h4 class="user-name mb-0">{{ $user->name }}</h4>
                                <h6 class="text-muted">{{ $user->email }}</h6>
                                <h6 class="text-muted">{{ $user->phone ?? 'No number Provided' }}</h6>
                                <div class="user-location">
                                    <i class="fas fa-map-marker-alt"></i> {{ $user->address ?? 'No address provided' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Card for Personal Details & Password Tab -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personal_details_tab">Personal
                                    Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Change Password</a>
                            </li>
                        </ul>

                        <div class="tab-content profile-tab-cont mt-4">
                            <!-- Personal Details Tab -->
                            <div class="tab-pane fade show active" id="personal_details_tab">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $user->name }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $user->email }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ $user->phone }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $user->address }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="profile_picture">Profile Picture</label>
                                        @if ($user->profile_picture)
                                            <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                                alt="Profile Picture" width="100">
                                        @endif
                                        <input type="file" name="profile_picture" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </form>
                            </div>

                            <!-- Password Tab -->
                            <div id="password_tab" class="tab-pane fade">
                                <form action="{{ route('profile.password.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" class="form-control" name="old_password" required />
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" name="new_password" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm New Password</label>
                                        <input type="password" class="form-control" name="new_password_confirmation"
                                            required />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Styling -->
    <style>
        .profile-image img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .page-header {
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .custom-height-card {
            min-height: 200px;
            /* You can adjust this value to increase or decrease the height */
        }
    </style>
@endsection
