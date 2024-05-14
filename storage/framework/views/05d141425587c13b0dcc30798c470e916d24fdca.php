<?php $__env->startSection('title'); ?>
Students
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
            Students
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            List
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php echo $__env->make('partials.session', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title mb-0">Students</h5>
                        <a href="<?php echo e(route('adduser')); ?>" type="button" class="btn btn-sm btn-primary">Add New</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="alternative-pagination"
                        class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>SR No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tbody>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($user->username); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td class="status">
                                        <?php if($user->roles->count() > 0): ?>
                                            <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($role->name == 'Super Admin'): ?>
                                                    <span class="badge badge-soft-success text-uppercase">
                                                        <?php echo e($role->name); ?>

                                                    </span>
                                                <?php elseif($role->name == 'Teacher'): ?>
                                                    <span class="badge badge-soft-danger text-uppercase">
                                                        <?php echo e($role->name); ?>

                                                    </span> 
                                                <?php elseif($role->name == 'Student'): ?>
                                                    <span class="badge badge-soft-primary text-uppercase">
                                                        <?php echo e($role->name); ?>

                                                    </span> 
                                                <?php else: ?>
                                                    <span class="badge badge-soft-dark text-uppercase">
                                                        <?php echo e($role->name); ?>

                                                    </span>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <span class="badge badge-soft-warning text-uppercase">
                                            No Role
                                        </span>
                                        <?php endif; ?>
                                    <td style="white-space: normal !important;">
                                        <?php if($user->username != 'admin'): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Role')): ?>
                                                <a href="<?php echo e(route('edituser',  encrypt($user->id))); ?>"
                                                    class="btn btn-sm btn-success">Edit</a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Role')): ?>
                                                <a data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo e($key); ?>"
                                                    class="btn btn-sm btn-danger">Delete</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal<?php echo e($key); ?>" tabindex="-1"
                                    aria-labelledby="deleteModalLabel<?php echo e($key); ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel<?php echo e($key); ?>">Confirm
                                                    Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this user?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <form action="<?php echo e(route('deleteuser', encrypt($user->id))); ?>"
                                                    method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH Z:\ZappFinity\LMS\learnify\resources\views/menu/students/list.blade.php ENDPATH**/ ?>