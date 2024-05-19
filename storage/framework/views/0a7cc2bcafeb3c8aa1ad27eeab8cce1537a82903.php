<?php $__env->startSection('title'); ?>
    Courses
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')); ?>" rel="stylesheet">
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Course
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            List
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php echo $__env->make('partials.session', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row mb-2">
        <div class="col-12">
            <div class="text-end">
                <?php if(Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher')): ?>
                    <a href="<?php echo e(route('addcourse')); ?>" class="btn btn-primary waves-effect waves-light">
                        <i class="ri-add-line align-middle me-2"></i> Add Course
                    </a>
                <?php else: ?>
                    <a type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#enroll">
                        <i class="ri-add-line align-middle me-2"></i> Enroll Course
                    </a>
                    <div class="modal fade
                                " id="enroll" tabindex="-1"
                        aria-labelledby="enrollLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="enrollLabel">Enroll
                                        Course</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body
                                            ">
                                    <form method="POST" action="<?php echo e(route('enrollcourse')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('POST'); ?>
                                        <div class="row">
                                            <input type="text" required class="form-control" name="code"
                                                placeholder="Enter Course Code">
                                            <div class="col-md-12 form-group mb-2">
                                                <a style="margin-right:3px;" href=""
                                                    class="btn btn-danger btn-sm">Cancel</a>
                                                <input type="submit" class="btn btn-success btn-sm">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="d-flex justify-content-between">
                                <div class="col">
                                    <h3 class="card-title text-primary text-bold"><?php echo e($course->name); ?></h3>
                                </div>
                                <div>
                                    <a class="btn btn-sm btn-info" href="<?php echo e(route('showcourse', $course->id)); ?>">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <?php if(Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher')): ?>
                                        <a type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal<?php echo e($course->id); ?>">
                                            <i class="ri-delete-bin-line"></i>
                                        </a>
                                    <?php endif; ?>
                                    <div class="modal fade
                                        "
                                        id="deleteModal<?php echo e($course->id); ?>" tabindex="-1"
                                        aria-labelledby="deleteModalLabel<?php echo e($course->id); ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel<?php echo e($course->id); ?>">Delete
                                                        Course</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div
                                                    class="modal-body
                                                    ">
                                                    <p>Are you sure you want to delete this course?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form method="POST" action="<?php echo e(route('deletecourse', $course->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('POST'); ?>
                                                        <input type="hidden" name="course" value="<?php echo e($course->id); ?>">
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher')): ?>
                                        <a type="button" href="<?php echo e(route('editcourse', $course->id)); ?>"
                                            class="btn btn-sm btn-primary">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-between mt-2">
                                <p class="card-text text-secondary fs-16"><?php echo e($course->teacher->username); ?></p>
                                <p class="card-text"><?php echo e($course->code); ?></p>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="col d-flex justify-content-between">
                                <p class="card-text text-dark">Created By</p>
                                <p class="card-text"><?php echo e($course->creator->username); ?></p>
                            </div>
                            <div class="col d-flex justify-content-between">
                                <p class="card-text text-dark">Start Date</p>
                                <p class="card-text"><?php echo e($course->start_date); ?></p>
                                <p class="card-text text-dark">End Date</p>
                                <p class="card-text"><?php echo e($course->end_date); ?></p>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <p class="card-text text-dark">Total Students</p>
                                </div>
                                <div class="col-auto d-flex">
                                    <p class="card-text mx-3">
                                        <?php echo e($course->students->count()); ?>

                                    </p>
                                    <?php if(Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher')): ?>
                                        <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addStudentModal<?php echo e($course->id); ?>">
                                            <i class="ri-user-add-line"></i>
                                        </a>
                                    <?php endif; ?>
                                    <div class="modal fade" id="addStudentModal<?php echo e($course->id); ?>" tabindex="-1"
                                        aria-labelledby="exampleModalgridLabel">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addStudentModalLabel">Add Student to
                                                        Course
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div
                                                    class="modal-body
                                                    ">
                                                    <form method="POST" action="<?php echo e(route('addstudenttocourse')); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('POST'); ?>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="student" class="form-label">Student
                                                                    <span style="color: red"> *</span>
                                                                </label>
                                                                <select class="form-select" name="student" required>
                                                                    <option value="">Select Student</option>
                                                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($student->id); ?>">
                                                                            <?php echo e($student->username); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <input type="hidden" name="course"
                                                                value="<?php echo e($course->id); ?>">
                                                            <div class="col-md-12 form-group mb-2">
                                                                <a style="margin-right:3px;" href=""
                                                                    class="btn btn-danger btn-sm">Cancel</a>
                                                                <input type="submit" class="btn btn-success btn-sm">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher')): ?>
                                <a type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#attendanceModal<?php echo e($course->id); ?>">
                                    Create Attendance
                                </a>
                            <?php endif; ?>
                            <div class="modal fade
                                "
                                id="attendanceModal<?php echo e($course->id); ?>" tabindex="-1"
                                aria-labelledby="attendanceModalLabel<?php echo e($course->id); ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="attendanceModalLabel<?php echo e($course->id); ?>">Create
                                                Attendance</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body
                                            ">
                                            <form method="POST" action="<?php echo e(route('storeeattendance')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('POST'); ?>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="date" class="form-label">Date
                                                            <span style="color: red"> *</span>
                                                        </label>
                                                        <input type="date" class="form-control" name="date"
                                                            placeholder="Select Date">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="date" class="form-label">Time
                                                            <span style="color: red"> *</span>
                                                        </label>
                                                        <input type="time" class="form-control" name="date"
                                                            placeholder="Select Date">
                                                    </div>
                                                    <input type="hidden" name="course" value="<?php echo e($course->id); ?>">
                                                    <div class="col-md-12 form-group mb-2">
                                                        <a style="margin-right:3px;" href=""
                                                            class="btn btn-danger btn-sm">Cancel</a>
                                                        <input type="submit" class="btn btn-success btn-sm">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- apexcharts -->
    <script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/libs/jsvectormap/jsvectormap.min.js')); ?>"></script>
    

    <!-- dashboard init -->
    <script src="<?php echo e(URL::asset('/assets/js/pages/dashboard-analytics.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="<?php echo e(URL::asset('assets/js/pages/datatables.init.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH Z:\ZappFinity\LMS\learnify\resources\views/menu/course_management/list.blade.php ENDPATH**/ ?>