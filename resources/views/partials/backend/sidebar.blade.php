    <!-- leftbar-tab-menu -->
    <div class="startbar d-print-none">
        <!--start brand-->
        <div class="brand">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <span>
                    <img src="{{ site_setting('logo_path') ? storage_url(site_setting('logo_path')) : asset('backend/assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">
                </span>
                <span class="">
                    <img src="{{ site_setting('logo_path') ? storage_url(site_setting('logo_path')) : asset('backend/assets/images/logo-light.png') }}" alt="logo-large" class="logo-lg logo-light">
                    <img src="{{ site_setting('logo_path') ? storage_url(site_setting('logo_path')) : asset('backend/assets/images/logo-dark.png') }}" alt="logo-large" class="logo-lg logo-dark">
                </span>
            </a>
        </div>
        <!--end brand-->
        <!--start startbar-menu-->
        <div class="startbar-menu" >
            <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
                <div class="d-flex align-items-start flex-column w-100">
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-auto w-100">
                        <li class="menu-label mt-2">
                            <span>Main</span>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="iconoir-report-columns menu-icon"></i>
                                <span>Dashboard</span>
                            </a>
                        </li><!--end nav-item-->

                        @role('Doctor')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.my-patients') ? 'active' : '' }}" href="{{ route('admin.my-patients') }}">
                                <i class="iconoir-user-plus menu-icon"></i>
                                <span>My Patients</span>
                            </a>
                        </li><!--end nav-item-->
                        @endrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Receptionist|Doctor')
                        <li class="menu-label mt-2">
                            <span>Patient Care</span>
                        </li>
                        @endhasanyrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Receptionist|Doctor')
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarPatients" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarPatients">
                                <i class="iconoir-user menu-icon"></i>
                                <span>Patients</span>
                            </a>
                            <div class="collapse" id="sidebarPatients">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.patients.index') }}">All Patients</a></li>
                                    @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Receptionist')
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.patients.create') }}">Add Patient</a></li>
                                    @endhasanyrole
                                </ul>
                            </div><!--end sidebarPatients-->
                        </li><!--end nav-item-->
                        @endhasanyrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin')
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarDoctors" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarDoctors">
                                <i class="iconoir-healthcare menu-icon"></i>
                                <span>Doctors</span>
                            </a>
                            <div class="collapse" id="sidebarDoctors">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.doctors.index') }}">All Doctors</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.doctors.create') }}">Add Doctor</a></li>
                                </ul>
                            </div><!--end sidebarDoctors-->
                        </li><!--end nav-item-->
                        @endhasanyrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Receptionist|Doctor')
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarAppointments" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarAppointments">
                                <i class="iconoir-calendar menu-icon"></i>
                                <span>Appointments</span>
                            </a>
                            <div class="collapse" id="sidebarAppointments">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.appointments.index') }}">All Appointments</a></li>
                                    @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Receptionist')
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.appointments.create') }}">New Appointment</a></li>
                                    @endhasanyrole
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.appointments.index') }}">OPD (Outpatient)</a></li>
                                    @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Receptionist|Nurse|Doctor')
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.admissions.index') }}">IPD (Admissions)</a></li>
                                    @endhasanyrole
                                </ul>
                            </div><!--end sidebarAppointments-->
                        </li><!--end nav-item-->
                        @endhasanyrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Doctor|Pharmacist')
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarPrescriptions" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarPrescriptions">
                                <i class="iconoir-clipboard menu-icon"></i>
                                <span>Prescriptions</span>
                            </a>
                            <div class="collapse" id="sidebarPrescriptions">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.prescriptions.index') }}">All Prescriptions</a></li>
                                    @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Doctor')
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.prescriptions.create') }}">New Prescription</a></li>
                                    @endhasanyrole
                                </ul>
                            </div><!--end sidebarPrescriptions-->
                        </li><!--end nav-item-->
                        @endhasanyrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Pharmacist|Lab Technician|Nurse|Ward Boy|Accountant')
                        <li class="menu-label mt-2">
                            <span>Operations</span>
                        </li>
                        @endhasanyrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Pharmacist')
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarPharmacy" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarPharmacy">
                                <i class="iconoir-pharmacy-cross-circle menu-icon"></i>
                                <span>Pharmacy</span>
                            </a>
                            <div class="collapse" id="sidebarPharmacy">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.pharmacy.index') }}">All Medicines</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.pharmacy.create') }}">Add Medicine</a></li>
                                </ul>
                            </div><!--end sidebarPharmacy-->
                        </li><!--end nav-item-->
                        @endhasanyrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Lab Technician')
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarLaboratory" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarLaboratory">
                                <i class="iconoir-flask menu-icon"></i>
                                <span>Laboratory</span>
                            </a>
                            <div class="collapse" id="sidebarLaboratory">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.lab-orders.index') }}">All Lab Orders</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.lab-orders.create') }}">New Lab Order</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.lab-tests.index') }}">Test Catalog</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.lab-tests.create') }}">Create Test</a></li>
                                </ul>
                            </div><!--end sidebarLaboratory-->
                        </li><!--end nav-item-->
                        @endhasanyrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Receptionist|Nurse|Ward Boy')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.beds.*') ? 'active' : '' }}" href="{{ route('admin.beds.index') }}">
                                <i class="iconoir-bed menu-icon"></i>
                                <span>Bed Availability</span>
                            </a>
                        </li><!--end nav-item-->
                        @endhasanyrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Accountant|Receptionist')
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarBilling" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarBilling">
                                <i class="iconoir-hand-cash menu-icon"></i>
                                <span>Billing &amp; Accounts</span>
                            </a>
                            <div class="collapse" id="sidebarBilling">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.invoices.index') }}">Invoices</a></li>
                                    @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Accountant')
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.invoices.create') }}">New Invoice</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.expenses.index') }}">Expenses</a></li>
                                    @endhasanyrole
                                </ul>
                            </div><!--end sidebarBilling-->
                        </li><!--end nav-item-->
                        @endhasanyrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin')
                        <li class="menu-label mt-2">
                            <span>Organization</span>
                        </li>
                        @endhasanyrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin')
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarStaff" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarStaff">
                                <i class="iconoir-group menu-icon"></i>
                                <span>Staff</span>
                            </a>
                            <div class="collapse" id="sidebarStaff">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">All Staff</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.create') }}">Add Staff</a></li>
                                </ul>
                            </div><!--end sidebarStaff-->
                        </li><!--end nav-item-->
                        @endhasanyrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Nurse|Ward Boy|Cleaner')
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarDutyBoard" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarDutyBoard">
                                <i class="iconoir-timer menu-icon"></i>
                                <span>Staff Duty Board</span>
                            </a>
                            <div class="collapse" id="sidebarDutyBoard">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.duty-logs.index') }}">All Duty Logs</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.duty-logs.create') }}">Start New Duty</a></li>
                                </ul>
                            </div><!--end sidebarDutyBoard-->
                        </li><!--end nav-item-->
                        @endhasanyrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Accountant')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
                                <i class="iconoir-stats-report menu-icon"></i>
                                <span>Reports &amp; Analytics</span>
                            </a>
                        </li><!--end nav-item-->
                        @endhasanyrole

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Receptionist')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.messages.index') }}">
                                <i class="iconoir-mail-in menu-icon"></i>
                                <span>Messages</span>
                                @if (($unreadMessagesCount ?? 0) > 0)
                                    <span class="badge bg-danger rounded-pill ms-auto">{{ $unreadMessagesCount }}</span>
                                @endif
                            </a>
                        </li><!--end nav-item-->
                        @endhasanyrole

                        @role('Super Admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.branches.*') ? 'active' : '' }}" href="{{ route('admin.branches.index') }}">
                                <i class="iconoir-hospital menu-icon"></i>
                                <span>Hospitals / Branches</span>
                            </a>
                        </li><!--end nav-item-->
                        @endrole

                        <li class="menu-label mt-2">
                            <span>Account</span>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.lock-screen') ? 'active' : '' }}" href="{{ route('admin.lock-screen') }}">
                                <i class="iconoir-lock menu-icon"></i>
                                <span>Lock Screen</span>
                            </a>
                        </li><!--end nav-item-->

                        @hasanyrole('Super Admin|Hospital Admin|Branch Admin|Doctor|Nurse|Ward Boy|Cleaner|Receptionist|Pharmacist|Lab Technician|Accountant')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}" href="{{ route('admin.notifications.index') }}">
                                <i class="iconoir-bell menu-icon"></i>
                                <span>Notifications</span>
                                @if (($unreadNotificationsCount ?? 0) > 0)
                                    <span class="badge bg-danger rounded-pill ms-1">{{ $unreadNotificationsCount }}</span>
                                @endif
                            </a>
                        </li><!--end nav-item-->
                        @endhasanyrole

                        @role('Super Admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.website') }}">
                                <i class="iconoir-settings menu-icon"></i>
                                <span>Website Settings</span>
                            </a>
                        </li><!--end nav-item-->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.page-content.*') ? 'active' : '' }}" href="{{ route('admin.page-content.index') }}">
                                <i class="iconoir-multi-window menu-icon"></i>
                                <span>Page Content</span>
                            </a>
                        </li><!--end nav-item-->
                        @endrole


                    </ul><!--end navbar-nav--->
                    <div class="update-msg text-center">
                        <div class="d-flex justify-content-center align-items-center thumb-lg update-icon-box  rounded-circle mx-auto">
                            <img src="{{ asset('backend/assets/images/extra/gold.png') }}" alt="" class="" height="45">
                        </div>
                        <h5 class="mt-3">Healix <span class="text-white">HMS</span></h5>
                        <p class="mb-3 text-muted">Hospital &amp; Clinic Management System.</p>
                    </div>
                </div>
            </div><!--end startbar-collapse-->
        </div><!--end startbar-menu-->
    </div><!--end startbar-->
    <div class="startbar-overlay d-print-none"></div>
    <!-- end leftbar-tab-menu-->
