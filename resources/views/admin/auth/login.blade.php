@extends('admin.layout.master')

@section('title', 'Login')

@section('content')

    @include('messages._message')

    <h1>Login</h1>
    <p class="account-subtitle">Enter your credentials to login</p>

    <form action="{{ route('auth.login.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Email <span class="login-danger">*</span></label>
            <input class="form-control" name="email" type="email" value="{{ old('email') }}" required>
            <span class="profile-views"><i class="fas fa-envelope"></i></span>
        </div>
        <div class="form-group">
            <label>Password <span class="login-danger">*</span></label>
            <input class="form-control pass-input" name="password" type="password" required>
            <span class="profile-views feather-eye toggle-password"></span>
        </div>
        <div class="form-group mb-0">
            <button class="btn btn-primary btn-block" type="submit">Login</button>
        </div>
    </form>

    <div class="login-or">
        <span class="or-line"></span>
        <span class="span-or">or</span>
    </div>

    {{-- <div class="social-login">
        <a href="#"><i class="fab fa-google-plus-g"></i></a>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
    </div> --}}

    <div class="dont-have">Don't have an account? <a href="{{ route('auth.register') }}">Sign up</a></div>
@endsection
