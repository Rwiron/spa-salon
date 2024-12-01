<!-- Topbar Start -->
<div class="container-fluid bg-light d-none d-lg-block">
    <div class="row py-2 px-lg-5">
        <div class="col-lg-6 text-left mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center">
                <small><i class="fa fa-phone-alt mr-2"></i>+250 784 635 535</small>
                <small class="px-3">|</small>
                <small><i class="fa fa-envelope mr-2"></i>alcobradubaikigali.com</small>
            </div>
        </div>
        <div class="col-lg-6 text-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-primary px-2" href="{{ url('https://www.facebook.com/alcobracenter/') }}" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
                {{-- <a class="text-primary px-2" href="" target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="text-primary px-2" href="" target="_blank">
                    <i class="fab fa-linkedin-in"></i>
                </a> --}}
                <a class="text-primary px-2" href="{{ url('https://www.instagram.com/rwanda_alcobra_dubai/?hl=en') }}"
                    target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-primary pl-2" href="{{ url('https://youtu.be/9hJPAjBcqIk') }}" target="_blank">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
        {{-- <a href="{{ url('/') }}" class="navbar-brand ml-lg-3">
            <h1 class="m-0 text-primary"><span class="text-dark">SPA</span> Alco</h1>
        </a> --}}
        <a href="{{ url('/') }}" class="navbar-brand ml-lg-3">
            <img src="{{ asset('img/logo12.png') }}" alt="SPA Alco Logo" style="height:60px;">
        </a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
            <div class="navbar-nav m-auto py-0">
                <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                <a href="{{ url('/about') }}" class="nav-item nav-link">About</a>
                <a href="{{ url('/provides') }}" class="nav-item nav-link">Services</a>
                <a href="{{ url('/price') }}" class="nav-item nav-link">Pricing</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="{{ url('/appointment') }}" class="dropdown-item">Appointment</a>
                        <a href="{{ url('/opening') }}" class="dropdown-item">Open Hours</a>
                        <a href="{{ url('/team') }}" class="dropdown-item">Our Team</a>
                        <a href="{{ url('/testimonial') }}" class="dropdown-item">Testimonial</a>
                        <a href="{{ url('/gallery') }}" class="dropdown-item">Our Galley</a>
                        <a href="{{ route('auth.register') }}" class="dropdown-item">Staff only</a>
                    </div>
                </div>
                <a href="{{ url('/contact') }}" class="nav-item nav-link">Contact</a>
                <a href="{{ route('auth.login') }}" class="nav-item nav-link">Join membership</a>


            </div>
            <a href="{{ url('/appointment') }}" class="btn btn-primary d-none d-lg-block">Book Now</a>
        </div>
    </nav>
</div>
<!-- Navbar End -->
