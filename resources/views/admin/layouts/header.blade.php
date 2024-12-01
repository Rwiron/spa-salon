<div class="header">
    <div class="header-left">
        <a href="#" class="logo">

            <span style="font-size: 20px; font-weight: bold; margin-left: 10px;">Alcobradubaikigali</span>
        </a>
        <a href="#" class="logo logo-small">
            <img src="{{ asset('assets/img/alcobra2.png') }}" alt="Logo" width="150" height="150">
        </a>
    </div>


    <div class="menu-toggle">
        <a href="javascript:void(0);" id="toggle_btn">
            <i class="fas fa-bars"></i>
        </a>

    </div>
    <a class="mobile_btn" id="mobile_btn">
        <i class="fas fa-bars"></i>
    </a>

    <ul class="nav user-menu">
        <!-- Language, Notification, Profile Dropdowns -->
        <li class="nav-item dropdown has-arrow new-user-menus">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img">
                    <div class="rounded-circle user-initials"
                        style="width: 36px; height: 41px; display: flex; align-items: center; justify-content: center; background-color: #e9a744e4; color: white; font-size: 16px;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="user-text">
                        <h6>{{ auth()->user()->name }}</h6>
                        <p class="text-muted mb-0">{{ auth()->user()->role->name }}</p>
                    </div>
                </span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">My Profile</a>
                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <a href="#" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>

            </div>
        </li>
    </ul>
</div>
