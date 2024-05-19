<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('assets/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('assets/images/logo-dark.png')); ?>" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('assets/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('assets/images/logo-light.png')); ?>" alt="" height="17">
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
                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?></span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('root')); ?>">
                        <i class=" ri-dashboard-line"></i> <span>Dashboard</span>
                    </a>
                </li>
                <?php if(Auth::user()->hasRole('Super Admin')): ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(route('viewusers')); ?>">
                            <i class="ri-team-line"></i> <span>Users</span>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('viewcourses')); ?>">
                        <i class="ri-draft-line"></i> <span>Courses</span>
                    </a>
                </li>
                <?php if(Auth::user()->hasRole('Super Admin')): ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(route('getteachers')); ?>">
                            <i class=" ri-user-6-fill"></i> <span>Teachers</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher')): ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(route('getstudents')); ?>">
                            <i class=" ri-user-2-line"></i> <span>Students</span>
                        </a>
                    </li> <!-- end Dashboard Menu -->
                <?php endif; ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<?php /**PATH Z:\ZappFinity\LMS\learnify\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>