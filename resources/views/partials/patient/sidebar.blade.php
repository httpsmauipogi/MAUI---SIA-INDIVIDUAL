    <!-- leftbar-tab-menu -->
    <div class="startbar d-print-none">
        <!--start brand-->
        <div class="brand">
            <a href="{{ route('patient.dashboard') }}" class="logo">
                <span>
                    <img src="{{ site_setting('logo_path') ? asset('storage/' . site_setting('logo_path')) : asset('backend/assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">
                </span>
                <span class="">
                    <img src="{{ site_setting('logo_path') ? asset('storage/' . site_setting('logo_path')) : asset('backend/assets/images/logo-light.png') }}" alt="logo-large" class="logo-lg logo-light">
                    <img src="{{ site_setting('logo_path') ? asset('storage/' . site_setting('logo_path')) : asset('backend/assets/images/logo-dark.png') }}" alt="logo-large" class="logo-lg logo-dark">
                </span>
            </a>
        </div>
        <!--end brand-->
        <div class="startbar-menu">
            <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
                <div class="d-flex align-items-start flex-column w-100">
                    <ul class="navbar-nav mb-auto w-100">
                        <li class="menu-label mt-2">
                            <span>My Account</span>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('patient.dashboard') ? 'active' : '' }}" href="{{ route('patient.dashboard') }}">
                                <i class="iconoir-report-columns menu-icon"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('patient.appointments') ? 'active' : '' }}" href="{{ route('patient.appointments') }}">
                                <i class="iconoir-calendar menu-icon"></i>
                                <span>My Appointments</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.appointment') }}">
                                <i class="iconoir-plus-circle menu-icon"></i>
                                <span>Book Appointment</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('patient.prescriptions*') ? 'active' : '' }}" href="{{ route('patient.prescriptions') }}">
                                <i class="iconoir-clipboard menu-icon"></i>
                                <span>My Prescriptions</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('patient.invoices*') ? 'active' : '' }}" href="{{ route('patient.invoices') }}">
                                <i class="iconoir-hand-cash menu-icon"></i>
                                <span>My Invoices</span>
                            </a>
                        </li>

                        <li class="menu-label mt-2">
                            <span>Account</span>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('patient.profile') ? 'active' : '' }}" href="{{ route('patient.profile') }}">
                                <i class="iconoir-user menu-icon"></i>
                                <span>My Profile</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.home') }}">
                                <i class="iconoir-home menu-icon"></i>
                                <span>Visit Website</span>
                            </a>
                        </li>
                    </ul>

                    <div class="update-msg text-center">
                        <div class="d-flex justify-content-center align-items-center thumb-lg update-icon-box rounded-circle mx-auto">
                            <img src="{{ asset('backend/assets/images/extra/gold.png') }}" alt="" height="45">
                        </div>
                        <h5 class="mt-3">Healix <span class="text-white">HMS</span></h5>
                        <p class="mb-3 text-muted">Your health, your records, always in reach.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="startbar-overlay d-print-none"></div>
    <!-- end leftbar-tab-menu-->
