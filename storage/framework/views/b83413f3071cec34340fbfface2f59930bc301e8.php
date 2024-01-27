<?php $__env->startSection('title'); ?>
    Roles
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <!-- Select2 css-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb Trail -->
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Roles
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Add
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <!-- Session Messages -->
    <?php echo $__env->make('partials.session', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Add employee Form -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title mb-0">Add Role</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form method="POST" action="<?php echo e(route('updaterole', encrypt($role->id))); ?>"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('POST'); ?>
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="role" class="form-label">Role Name<span style="color: red">
                                            *</span></label>
                                    <div>
                                        <input type="text" value="<?php echo e($role->name); ?>" required
                                            class="form-control form-control-icon has-validation" id="role"
                                            name="role" placeholder="Enter title">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="description" class="form-label">Role Description<span style="color: red">
                                            *</span></label>
                                    <div>
                                        <input type="text" value="<?php echo e($role->description); ?>"
                                            class="form-control form-control-icon" id="description" name="description"
                                            placeholder="Enter Description">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 form-group">
                                    <label for="choices-multiple-remove-button" class="form-label">
                                        Select Permissions for Role<span style="color: red"> *</span>
                                    </label>
                                    <select required class="js-example-basic-multiple" name="permissions[]"
                                        multiple="multiple">
                                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($role->hasPermissionTo($permission->name)): ?> selected <?php endif; ?>>
                                                <?php echo e($permission->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group mb-2">
                                    <a style="margin-right:3px;" href="<?php echo e(route('viewroles')); ?>"
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Select2 cdn -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/select2.init.js')); ?>"></script>
    <!-- Input Mask -->
    <script src="<?php echo e(URL::asset('assets/libs/cleave.js/cleave.js.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/form-masks.init.js')); ?>"></script>
    <!-- App JS -->
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>

    <script src="<?php echo e(URL::asset('assets/libs/prismjs/prismjs.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH Z:\ZappFinity\LMS\learnify\resources\views/menu/user_management/roles/edit.blade.php ENDPATH**/ ?>