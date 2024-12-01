@include('admin.layout.header')

<div class="main-wrapper login-body">
    <div class="login-wrapper">
        <div class="container">
            <div class="loginbox">
                <div class="login-left">
                    <img class="img-fluid" src="{{ asset('assets/img/alcoraw.png') }}" alt="Logo">
                </div>
                <div class="login-right">
                    <div class="login-right-wrap">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.layout.footer')
