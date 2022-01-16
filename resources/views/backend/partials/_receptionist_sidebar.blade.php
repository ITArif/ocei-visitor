<aside class="main-sidebar elevation-4 sidebar-light-teal">
  <a href="{{route('receptionist.dashboard')}}" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 240px; object-fit: cover;">
  </a>
  <!-- Sidebar -->
    <!-- Sidebar user panel (optional) -->
    <!-- <div class="mt-5 pb-3 mb-3 d-flex">
    <a href="#" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 240px; object-fit: cover;">

    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="mt-5 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('images/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="javascript:void(0)" class="d-block">{{ session('name') }}</a>
      </div>
    </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="{{ route('receptionist.dashboard') }}"
                        class="nav-link {{ request()->is('receptionists-dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('checkAppointmentList') }}" class="nav-link {{ request()->is('receptionists/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-search text-primary"></i>
                        <p>
                        All Appointments
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('checkAppointmentList') }}"
                                class="nav-link {{ request()->is('receptionists/appointment/list') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-green"></i>
                                <p>Appointment</p>
                            </a>
                        </li>
                    </ul> -->
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('appontmentHistoryData') }}"
                        class="nav-link {{ request()->is('appointment/history') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user-secret text-info"></i>
                        <p>
                            Ongoing Appointments
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('archiveAppointmentData') }}"
                        class="nav-link {{ request()->is('archive/appointment') ? 'active' : '' }}">
                        <i class="fa fa-archive text-yellow" aria-hidden="true"></i>
                        <p>
                           Archived Appointments
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
