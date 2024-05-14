<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.calendar'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('/assets/libs/fullcalendar/fullcalendar.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Apps
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Calendar
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div id="external-events">
                    </div>
                </div> <!-- end col-->

                <div class="col-xl-9">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div><!-- end col -->
            </div>
            <!--end row-->

            

            <!-- Add New Event MODAL -->
            
            <!-- end modal-->
        </div>
    </div> <!-- end row-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('assets/libs/fullcalendar/fullcalendar.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/calendar.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH Z:\ZappFinity\LMS\learnify\resources\views/apps-calendar.blade.php ENDPATH**/ ?>