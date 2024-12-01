<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <!-- Main Menu -->
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>

                <!-- Super Admin Access Only -->
                @if (Auth::check() && Auth::user()->role->name == 'Super Admin')
                    <!-- Dashboard -->
                    <li class="submenu">
                        <a href="#"><i class="feather-grid"></i> <span> Dashboard</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('superadmin.dashboard') }}">Admin Dashboard</a></li>
                        </ul>
                    </li>

                    <!-- Management Section -->
                    <li class="menu-title">
                        <span>Management</span>
                    </li>

                    <!-- Service Management -->
                    <li class="submenu">
                        <a href="#"><i class="feather-list"></i> <span> Service </span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('facilities.index') }}">Add New Service</a></li>
                            <li><a href="{{ route('service_types.index') }}">Service Categories</a></li>
                            <li><a href="{{ route('facility.services.index') }}">View Services</a></li>
                        </ul>
                    </li>

                    <!-- Appointment Management -->
                    <li class="submenu">
                        <a href="#"><i class="feather-calendar"></i> <span> Appointment </span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('appointments.index') }}">Appointments Request</a></li>
                            <li><a href="{{ route('appointments.accepted') }}">Accepted Appointments</a></li>
                        </ul>
                    </li>

                    <!-- Content Management -->
                    <li class="submenu">
                        <a href="#"><i class="feather-file-text"></i> <span> Content </span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('home.carousel.index') }}">Homepage</a></li>
                            <li><a href="{{ route('about.index') }}">About Page</a></li>
                            <li><a href="{{ route('provide.index') }}">Our Services</a></li>
                            <li><a href="{{ route('openhours.index') }}">Open Hours</a></li>
                            <li><a href="{{ route('pricingplan.index') }}">Pricing</a></li>
                            <li><a href="{{ route('pricingfeatures.index') }}">Pricing Feature</a></li>
                            <li><a href="{{ route('admin.pricing.index') }}">Show Pricing</a></li>
                            <li><a href="{{ route('team.index') }}">Team Spa Speacialist</a></li>
                            <li><a href="{{ route('testimonials.index') }}">Testimonial</a></li>
                            <li><a href="{{ route('admin.contacts.index') }}">Contact</a></li>
                            <li><a href="{{ route('tariffs.index') }}">Tariff</a></li>
                            <li><a href="{{ route('gallery.index') }}">Galley</a></li>
                        </ul>
                    </li>


                    <!-- User Management -->
                    <li class="submenu">
                        <a href="#"><i class="feather-users"></i> <span> User </span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('users.index') }}">Users</a></li>
                        </ul>
                    </li>
                @endif

                <!-- Customer Access Only -->
                @if (Auth::check() && Auth::user()->role->name == 'Customer')
                    <li class="submenu">
                        <a href="#"><i class="feather-grid"></i> <span> Dashboard</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('customer.dashboard') }}">Customer Dashboard</a></li>
                        </ul>
                    </li>

                    <!-- Customer Pages -->
                    <li class="menu-title">
                        <span>Pages</span>
                    </li>

                    <li class="submenu">
                        <a href="#"><i class="feather-layers"></i> <span> Website Pages </span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
