<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.signin'); ?>
<?php $__env->stopSection(); ?>
<style>
    .custom-auth-bg {
        background: #6699ff !important;
        background-size: cover;
    }

    body,
    .bg-custom-auth {
        background-color: #fff !important;
    }

    .custom-fill {
        fill: #fff !important;
    }

    .card {
        box-shadow: 0 4px 8px 0 #6699ff, 0 6px 20px 0 #6699ff !important;
    }

    .invalid-feedback {
        display: inline-block !important;
    }
</style>
<?php $__env->startSection('content'); ?>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg custom-auth-bg" id="auth-particles">
            <div class="custom-bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path class="custom-fill"
                        d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index" class="d-inline-block auth-logo">
                                    <h1 class="fs-36 text-white">LEARNIFY</h1>
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-semibold">Get the best experience with us</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-secondary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to Leanify.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="<?php echo e(route('login')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                value="<?php echo e(old('email', 'admin@learnify.com')); ?>" id="username"
                                                name="email" placeholder="Enter username">
                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="auth-pass-reset-basic" class="text-muted">Forgot password?</a>
                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div x-data="{ show: false }"
                                                class="position-relative auth-pass-inputgroup mb-3">
                                                <input x-bind:type="show ? 'text' : 'password'"
                                                    class="form-control pe-5 
                                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    name="password" placeholder="Enter password" id="password-input"
                                                    value="123456">
                                                <div class="position-absolute top-50 end-0 translate-middle-y me-3">
                                                    <a href="javascript: void(0);" class="text-muted"
                                                        x-on:click="show = !show">
                                                        <i class="mdi mdi-eye-outline" x-bind:class="{'mdi-eye': show, 'mdi-eye-outline': !show}"></i>
                                                    </a>
                                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>



                                        <div class="mt-4">
                                            <button class="btn btn-secondary w-100" type="submit">Sign In</button>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <p class="mb-0">Don't have an account ? <a href="register"
                                                    class="fw-bold text-secondary"> Signup </a> </p>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->


                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('assets/libs/particles.js/particles.js.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/particles.app.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/password-addon.init.js')); ?>"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-without-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH Z:\ZappFinity\LMS\learnify\resources\views/auth/login.blade.php ENDPATH**/ ?>