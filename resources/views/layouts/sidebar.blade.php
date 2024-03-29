<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>
                @canany(['View Course'])
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#course_management" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="course_management">
                            <i class="ri-draft-line"></i> <span>Course Management</span>
                        </a>
                        <div class="collapse menu-dropdown" id="course_management">
                            <ul class="nav nav-sm flex-column">
                                @can('View Course')
                                    <li class="nav-item">
                                        <a href="{{ route('viewcourses') }}" class="nav-link">Courses</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                @endcanany
                @canany(['View Role', 'View User'])
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#user_management" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="user_management">
                            <i class="ri-user-line"></i> <span>User Management</span>
                        </a>
                        <div class="collapse menu-dropdown" id="user_management">
                            <ul class="nav nav-sm flex-column">
                                @can('View Role')
                                    <li class="nav-item">
                                        <a href="{{ route('viewroles') }}" class="nav-link">Roles</a>
                                    </li>
                                @endcan
                                @can('View User')
                                    <li class="nav-item">
                                        <a href="{{ route('viewusers') }}" class="nav-link">Users</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                @endcanany
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
