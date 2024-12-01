@extends('admin.layout.master')

@section('title', 'Register')

@section('content')
    <h1>Sign Up</h1>
    <p class="account-subtitle">Enter details to create your account</p>

    <form action="{{ route('auth.register.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Username <span class="login-danger">*</span></label>
            <input class="form-control" name="name" type="text" required>
            <span class="profile-views"><i class="fas fa-user-circle"></i></span>
        </div>
        <div class="form-group">
            <label>Email <span class="login-danger">*</span></label>
            <input class="form-control" name="email" type="email" required>
            <span class="profile-views"><i class="fas fa-envelope"></i></span>
        </div>
        <div class="form-group">
            <label>Password <span class="login-danger">*</span></label>
            <input class="form-control pass-input" name="password" type="password" required>
            <span class="profile-views feather-eye toggle-password"></span>
        </div>
        <div class="form-group">
            <label>Confirm password <span class="login-danger">*</span></label>
            <input class="form-control pass-confirm" name="password_confirmation" type="password" required>
        <span class="profile-views feather-eye reg-toggle-password"></span>
        </div>
        <div class=" dont-have">Already Registered? <a href="{{ route('auth.login') }}">Login</a></div>
        <div class="form-group mb-0">
            <button class="btn btn-primary btn-block" type="submit">Register</button>
        </div>
    </form>
@endsection
